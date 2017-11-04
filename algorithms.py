import numpy as np
import pandas as pd
from mpl_toolkits.basemap import Basemap
import matplotlib.pyplot as plt
import gpxpy.geo

def drawMap(queue, responder_data):

    plt.figure(1, figsize=(10, 8))
    zoom = 0.2
    map = Basemap(projection='merc', llcrnrlat=49-zoom, urcrnrlat=60+zoom,
                llcrnrlon=-11-zoom, urcrnrlon=3+zoom, resolution='i')
    map.drawcoastlines()
    map.drawparallels(np.arange(-90, 90, 30), labels=[1, 0, 0, 0])
    map.drawmeridians(np.arange(map.lonmin, map.lonmax + 30, 60), labels=[0, 0, 0, 1])
    map.drawmapboundary(fill_color='grey')
    map.drawstates()
    map.drawcounties()

    lons = queue['Long'].values
    lats = queue['Lat'].values
    x, y = map(lons, lats)
    map.scatter(x, y, 6, marker='o', color='y')

    lons = responder_data['Long'].values
    lats = responder_data['Lat'].values
    x, y = map(lons, lats)
    map.scatter(x, y, 6, marker='o', color='w')

    plt.title('Map of Users and Responders')
    plt.show()


queue = pd.read_csv("/Users/alexanderjmackechnie/Desktop/code_for_good/user_data.csv")
responder_data = pd.read_csv("/Users/alexanderjmackechnie/Desktop/code_for_good/responder_data.csv")

print(queue)
print("\n\n")
print(responder_data)
print("\n\n")

drawMap(queue, responder_data)

if len(queue) != 1:
    #Initially reorder the list by urgency
    queue = queue.sort_values(['Urgency'], kind='quicksort')
    queue = queue.iloc[::-1]
    queue = queue.reset_index(drop=True)
    print(queue)
    print("\n\n")

#Loop through from the most urgent user.
for i, queueRow in queue.iterrows():
    print("User " + str(i))

    responderScores = np.zeros(len(responder_data), dtype=np.int)
    responderDistances = np.zeros(len(responder_data), dtype=np.int)

    for j, responderRow in responder_data.iterrows():

        #Rate the responder based on the Sector.
        if queueRow['Sector'] == responderRow['Sector']:
            responderScores[j] += 50

        # Rate the user based on the Location
        responderDistances[j] = gpxpy.geo.haversine_distance(queueRow['Lat'], queueRow['Long'], responderRow['Lat'], responderRow['Long'])
        if j > 1:
            if responderDistances[j] <
        # if queueRow['Location'] == responderRow['Location']:
        #     responderScores[j] += 20

        #Rate the user based on their Sex.
        if queueRow['Sex'] == responderRow['Sex']:
            responderScores[j] += 20

        #Rate the user based on their Age.
        if queueRow['Age'] == responderRow['Age']:
            responderScores[j] += 10

    print(str(responderScores))
    print(str(responderDistances))
    print("Responder " + str(np.argmax(responderScores)) + " is most suitable.\n")
