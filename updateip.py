# script to update IP at netplex machine

import urllib.request
import urllib.parse

name = ""
code = ""

url = "" + name + "&code=" + code
urllib.request.urlopen(url)
