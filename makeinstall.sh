#!/bin/bash
cd `dirname $0`
rm -rf admin/help/en-GB latex
doxygen 
make -C latex refman.pdf
version=`grep -e '<version>' townoffical.xml|sed 's|\(^.*<version>\)\(.*\)\(</version>.*$\)|\2|'`
rm -f com_TownOfficalDB-$version.zip
zip -r com_TownOfficalDB-$version.zip . -x@exclude.lst
