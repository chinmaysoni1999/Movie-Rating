#! /usr/bin/python3
movies = open('movies.txt', 'r')
ratings = open('ratings.txt', 'r')
description = open('description.txt', 'r')
total = open('total.txt', 'r')
sqlspit = open('../php/sqlspit','w+')
filespit = open('../php/filespit','w+')

for line in movies:
	lines = "'"+line.strip()+"'"
	rating = ratings.readline().strip()
	des = "'"+description.readline().strip()+"'"
	tot = total.readline().strip()

	filename = "../images/"+line.strip().replace(" ","") + ".jpg\n"
	more = "$sqlQuery = insert into $table (name, image, description, rating, total) values (%s,^image^,%s,%s,%s);\n"%(lines,des,rating,tot)
	sqlspit.write(more)
	filespit.write(filename)

