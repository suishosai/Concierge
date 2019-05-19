"""
Overview:
DataParser.py gets divided words list from given input.
this uses Yahoo Developers API which divide sentences into words and shows what kind of words they are.
This outputs keywords in given sentences which are correspond to main keywords such as group name.

@usage DataParser.py -input "data.csv"
@license MIT
@author Manato1fg
"""

import argparse
import urllib.request
import urllib.parse
import xml.etree.ElementTree as ET
import csv
import os


def main():
    input_file = input_parse()

    template = './template.html'
    i = 0
    ary = []
    ary.append(["id","name","description","keywords","url"])
    outputfolder = "./output/"
    os.makedirs(outputfolder, exist_ok=True)
    base_url = "https://jlp.yahooapis.jp/MAService/V1/parse?appid=dj00aiZpPTN1U1QzQzh5aVNBUSZzPWNvbnN1bWVyc2VjcmV0Jng9MzA-&results=ma,uniq&uniq_filter=9%7C10&sentence="
    with open(template) as t:
        d = t.read()
        with open(input_file, 'r') as f:
            reader = csv.reader(f)
            header = next(reader)

            for row in reader:
                i += 1
                o_id, o_name, o_composition, o_place, o_description = row
                newfile = o_id.replace("-", "")+".html"
                o_url = "https://suishosai.netlify.com/events/"+newfile
                print(o_url)
                s = o_composition + ":" + o_name + ":" + o_place + ":"
                res = [o_id, o_name, o_description]
                url = base_url + urllib.parse.quote(o_description)
                image_url = "https://suishosai.netlify.com/images/" + o_id.replace("-", "")+".png"
                req = urllib.request.Request(url)
                with urllib.request.urlopen(req) as response:
                    XmlData = response.read()
                    root = ET.fromstring(XmlData)
                    for child1 in root:
                        if child1.tag == '{urn:yahoo:jp:jlp}uniq_result':
                            for child2 in child1:
                                if child2.tag == '{urn:yahoo:jp:jlp}word_list':
                                    for child3 in child2:
                                        for child4 in child3:
                                            if child4.tag == '{urn:yahoo:jp:jlp}surface':
                                                s += child4.text + ":"
                res.append(s[0:-1])
                res.append(o_url)
                ary.append(res)
                with open(outputfolder+newfile, "w") as ff:
                    newdata = d.replace("variable1", o_name).replace("variable2", o_composition).replace("variable3", o_place).replace("variable4", image_url).replace("variable5", o_description)
                    ff.write(newdata)
    with open('output.csv', 'w') as f:
        writer = csv.writer(f, lineterminator='\n')
        writer.writerows(ary)
    
    print(i)


def input_parse():
    parser = argparse.ArgumentParser()
    parser.add_argument("-input", required=True)
    args = parser.parse_args()

    return args.input


if __name__ == "__main__":
    main()
