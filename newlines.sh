#!/bin/bash

if [ "$1" = "" ] ; then 
    echo -e "Specify file"
    exit 1;
fi

cat $1 > $1.backup

echo -e "Fix newlines"
sed \
    -e 's/>/>\
/g' \
    -e 's/[ ]*//g' \
    $1.backup > $1 && echo "OK" || exit 1 
echo -e "Backup File saved as $1.backup"