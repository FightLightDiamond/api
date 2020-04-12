#!/bin/bash

# Path and folder
pathMount="/magentonfs/"
versionBuild="magento-0"
sourceCode="${pathMount}feca_magento/"
versionBuildSource="${pathMount}${versionBuild}"
shareCource="${pathMount}magento"

echo $sourceCode
echo $versionBuildSource

# Make new folder
echo "Make new folder"
mkdir "${versionBuildSource}"

# Copy file to new folder
echo "Copy file to new folder"
copyTime=$(date +'%s')
cp -af "${sourceCode}".* "${versionBuildSource}"
echo "Copy $(($(date +'%s') - copyTime)) seconds"

# Pull new source
pullCodeTime=$(date +'%s')
cd "${versionBuildSource}"
echo "Pull new source"
git pull origin master
echo "Copy $(($(date +'%s') - pullCodeTime)) seconds"

# Chown
chownTime=$(date +'%s')
sudo -u magento chown -R magento:apache "${versionBuildSource}"
echo "Copy $(($(date +'%s') - chownTime)) seconds"

# Deploy mangento
echo "Deploy mangento"
magentoCommandTime=$(date +'%s')
sudo -u magento php -dmemory_limit=2G bin/magento module:enable --all
sudo -u magento php -dmemory_limit=2G bin/magento c:c
sudo -u magento php -dmemory_limit=2G bin/magento s:up
sudo -u magento php -dmemory_limit=2G  bin/magento s:d:c
sudo -u magento php -dmemory_limit=2G ./bin/magento setup:static-content:deploy --jobs 10 -f th_TH en_US --theme Magento/backend --theme Feca/FecaAsia2
echo "Copy $(($(date +'%s') - magentoCommandTime)) seconds"

# Symlink from new folder to source code folder
symlinkTime=$(date +'%s')
rm -rf "${shareCource}"
mkdir "${shareCource}"
sudo -u magento ln -sf "${versionBuildSource}/".* "${shareCource}"
echo "Copy $(($(date +'%s') - symlinkTime)) seconds"
