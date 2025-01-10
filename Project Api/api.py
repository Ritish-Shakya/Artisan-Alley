from flask import Flask, request, jsonify
import joblib
import numpy as np
import pandas as pd
from flask_cors import CORS
# flask user garera api banako tesko lagi flask install garna parxa
# cors cross origin resource sharing ko lagi use gareko
app = Flask(__name__)
CORS(app)       # Allows all other addressed to access the api

#pahila CORS milauna parxa
# aba Request line post ko
model_data = joblib.load('kmeansClustering.pkl') #save gareko model load garya
optimal_centroids = model_data['centroids']

@app.route('/cluster', methods=['POST'])
def cluster():
    data = request.json #mathi ko route ko body ma request data ma store hunxa
    new_data = pd.DataFrame(data)# matrix type ma basxa pd.Dataframe
    X = new_data[['Total Purchase in Rupees', 'purchase_frequency']].values

    def euclidean_distance(point1, point2):
        return np.sqrt(np.sum((point1 - point2) ** 2))

    def assign_clusters(X, centroids):
        clusters = []
        for point in X:
            distances = [euclidean_distance(point, centroid) for centroid in centroids]
            closest_centroid = np.argmin(distances)
            clusters.append(closest_centroid)
        return np.array(clusters)

    clusters_created = assign_clusters(X, optimal_centroids)

    return jsonify({'clusters': clusters_created.tolist()})


if __name__ == '__main__':
    app.run(debug=True)
