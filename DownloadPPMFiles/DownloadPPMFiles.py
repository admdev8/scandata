
'''
DOWNLOAD PPM FILES FROM ARCHIVE.ORG
Jeff Thompson | 2015 | wwww.jeffreythompson.org

Gets the weird ones.


REQUIRES BING SEARCH PYTHON MODULE
https://github.com/binilinlquad/bing-search-api

MORE INFO ON BING SEARCH API
https://onedrive.live.com/view.aspx?resid=9C9479871FBFA822!109&app=Word&authkey=!ACvyZ_MNtngQyCU
'''

import os, json, urllib, zipfile, requests, os, shutil, uuid
from BingSearchAPI import BingSearchAPI
from PIL import Image
from OAuthSettings import settings



num_results =  	50			# how many search results from Bing (max = 50)
num_pages = 	5			# how many pages of 'num_results' to get
zip_filename = 	'temp.zip'	# temp filename for zip files

app_key = 		settings['app_key']
customer_key = 	settings['customer_key']

__location__ = 	os.path.realpath(os.path.join(os.getcwd(), os.path.dirname(__file__)))


def getEmAll(item):

	# already did it?
	with open(os.path.join(__location__, 'PPM_Files.txt')) as f:
		for line in f:
			if item == line.strip():
				print 'Already downloaded! Skipping...'
				return

	# download the zip file
	print 'Downloading...'
	try:
		url = 'https://archive.org/download/' + item + '/scandata.zip'
		url = url.encode('utf-8')
		print '- ' + url
		urllib.urlretrieve(url, zip_filename)
	except:
		print '- ERROR DOWNLOADING FILE!'
		return

	# create Zip object
	try:
		zip = zipfile.ZipFile(zip_filename)
	except:
		print '- ERROR, NOT REALLY A ZIP FILE :('
		return

	# extract PPM files
	print 'Extracting PPM files...'
	for i, f in enumerate(zip.namelist()):
		if f.endswith('.ppm'):
			print '- ' + f
			try:
				file_data = zip.read(f, __location__)
				file_path = os.path.join(__location__, f.split('/')[-1])
				ppm_filename = os.path.join(__location__, 'PPM', item + '_' + str(i) + '.ppm')

				print '- saving as ' + ppm_filename + '...'
				with open(ppm_filename, 'wb') as out:
					out.write(file_data)

			except Exception, e:
				print '- ERROR EXTRACTING FILE, SORRY!'
				continue

			try:
				print '- converting to jpg file...'
				jpg_filename = os.path.join(__location__, 'JPG', item + '_' + str(i) + '.jpg')
				im = Image.open(ppm_filename)
				im.save(jpg_filename)

				print 'Deleting PPM file...'
				os.remove(ppm_filename)

			except Exception, e:
				print '- ERROR CONVERTING FILE (LEAVING AS PPM)'
				continue


	# done, close it up and delete zip, save ID to file for later use
	try:
		print 'Deleting temp ZIP file...'
		zip.close()
		os.remove(zip_filename)

		print 'Adding ID to list...'
		with open(os.path.join(__location__, 'PPM_Files.txt'), 'a') as o:
			o.write(item + '\n')
	except:
		pass


# search for URLs
print '\n\n' + 'SEARCHING...'
links = []
for i in range(num_pages):
	print '- ' + str(i * num_results) + '-' + str((i+1) * num_results)
	api = BingSearchAPI(os.getenv(app_key, customer_key))
	params = { '$format': 'json', '$top': num_results, '$skip': (i * num_results) }
	results = api.search_web('scandata.zip site:archive.org', payload=params).json()

	for i, link in enumerate(results['d']['results']):
		url = link['Url']
		url = os.path.basename(url)
		links.append(url)

print '\nFound ' + str(len(links)) + ' links to download'  + '\n\n- - - - -'


# download the PPM files!
for i, link in enumerate(links):
	print '\n' + str(i+1) + '/' + str(len(links)) + ': ' + link.upper()
	getEmAll(link)


# done
print '\n\n' + 'ALL DONE!' + '\n'

