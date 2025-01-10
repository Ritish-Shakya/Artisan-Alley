from flask import Flask, request, jsonify
import joblib
import numpy as np
import pandas as pd

app = Flask(__name__)

model_data = joblib.load('kmeansClustering.pkl') #save gareko model load garya
optimal_centroids = model_data['centroids']

new_data = [
    {
        #yo data haru chaii registered data hunxa project
        "Total_purchase": 120.5,
        "Purchase_count": 20
    },
    {
        "Total_purchase": 250.75,
        "Purchase_count": 35
    },
    {
        "Total_purchase": 75.2,
        "Purchase_count": 10
    },
    {
        "Total_purchase": 3000.4,
        "Purchase_count": 80
    },
    {
        "Total_purchase": 150.0,
        "Purchase_count": 25
    },
    {
        "Total_purchase": 95.5,
        "Purchase_count": 15
    },
    {
        "Total_purchase": 220.3,
        "Purchase_count": 30
    },
    {
        "Total_purchase": 180.6,
        "Purchase_count": 28
    },
    {
        "Total_purchase": 310.1,
        "Purchase_count": 50
    },
    {
        "Total_purchase": 140.9,
        "Purchase_count": 22
    }
]
sample_df = pd.DataFrame(new_data)
x_sample = sample_df.values

print(x_sample)


@app.route('/cluster', methods=['POST'])
def cluster():
    def euclidean_distance(point1, point2):
        return np.sqrt(np.sum((point1 - point2) ** 2))

    def assign_clusters(X, centroids):
        clusters = []
        for point in X:
            distances = [euclidean_distance(point, centroid) for centroid in centroids]
            closest_centroid = np.argmin(distances)
            clusters.append(closest_centroid)
        return np.array(clusters)

    clusters_created = assign_clusters(x_sample, optimal_centroids)

    return jsonify({'clusters': clusters_created.tolist()})


if __name__ == '__main__':
    app.run(debug=True)
