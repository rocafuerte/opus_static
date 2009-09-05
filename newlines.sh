#!/bin/bash

if [ "$1" = "" ] ; then 
    echo -e "Specify file"
    exit 1;
fi

echo -e "Fix newlines"
sed \
    -e 's/>/>\
/g' \
    -e 's/[ ]*//g' \
    $1 > $1.sed && echo "OK" || exit 1 
echo -e "File saved as $1.sed"