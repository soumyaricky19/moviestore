import csv 
import sys
 
f = open("E:\MSCS_StudyMaterial\Fall 2017\WPL\Final_Project\IMDB-Movie-Data - Genre.csv")
file1 = open("E:\MSCS_StudyMaterial\Fall 2017\WPL\Final_Project\IMDB-Movie-Data_GenreId_GenreName.csv","w",newline="")
file2 = open("E:\MSCS_StudyMaterial\Fall 2017\WPL\Final_Project\IMDB-Movie-Data_MovieId_GenreId.csv","w",newline="")
writer1 = csv.writer(file1)
writer2 = csv.writer(file2)

act = []

reader = csv.reader(f)
dictActors = {}
movieActor = {}
actor = set()
actorid = 0
for row in reader:
    id = row[0]
    actors = row[1]
    listA = actors.split(",")
    for a in listA:
        a = a.strip()
        if a not in actor:
            actor.add(a)
            actorid += 1
            dictActors[actorid] = a
        l = []
        l.append(id)
        l.append(list(dictActors.keys())[list(dictActors.values()).index(a)])
        act.append(l)
#print(dictActors)
# print("""""""""""""""""""""""""""""""")
#print(movieActor)
for i in act:
    writer2.writerow(i)
for k,v in dictActors.items():
    writer1.writerow((str(k),str(v)))
    
