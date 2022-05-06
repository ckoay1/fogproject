#!/bin/bash

# Create log directory
sudo mkdir -p -- /PXEL/AzurePipeline/Logs/

# Download latest PXEL's source code
echo "   ###########################################"
echo "     Downloading Compressed PXEL Setup File   "
echo "   ###########################################"
currDate="$(date +'%Y%m%d')"
output="$(sudo wget -a /PXEL/AzurePipeline/Logs/${currDate}_wgetlog.txt ${1%.*}/archive/$2.tar.gz -P /opt/)"

if [[ $? -ne 0 ]] ; then
    echo "Failed to download FOG Project latest source code."
    echo "To view log details please refer to /PXEL/AzurePipeline/Logs/${currDate}_wgetlog.txt"
    exit $?
else
    echo "Successfully downloaded latest FOG Project source code."
    echo "To view log details please refer to /PXEL/AzurePipeline/Logs/${currDate}_wgetlog.txt"
fi

# Untar the latest source code file
echo "   ###########################################"
echo "           Extracting PXEL Setup File         "
echo "   ###########################################"
sudo tar -C /opt -xvzf /opt/$3.tar.gz

# Clean up tar file
sudo rm /opt/$3.tar.gz

# Execute installfog.sh to install fog or update new release
echo "   ###########################################"
echo "           Installing PXEL into system        "
echo "   ###########################################"
FILE=/opt/fog/.fogsettings
if sudo test -f "$FILE"; then
   echo "$FILE exists. Will peform an upgrade to PXEL"
   printf "Y\n\n" |  sudo /opt/fogproject-$3/bin/installfog.sh
else
   echo "$FILE does not exists. Will peform a fresh installation of PXEL"
fi

