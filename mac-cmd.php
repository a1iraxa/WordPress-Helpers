https://thewebsitedev.com/compress-folders-mac-ds_store-files/
zip -r my-folder.zip my-folder -x "*.DS_Store"

zip is a compression and packaging file utility for Unix.
-r is for recursively including all folders underneath the target folder.
my-folder.zip is the name of the compressed file we want to create.
my-folder is the name of our target folder. The folder we want compressing.
-x "*.DS_Store" is to exclude all files whose path ends with the string “.DS_Store”.

unzip my-foler.zip

/////////////////
https://apple.stackexchange.com/questions/32785/is-there-a-way-to-show-the-speed-of-copying-files-on-a-mac

If you're comfortable in the Terminal, you can use rsync to copy some files from one place to another and it'll give you summary stats on the speed:

rsync -a --progress --stats --human-readable path_to_source path_to_dest
E.g. rsync --stats --human-readable ~/Desktop/Large-File /Volumes/OtherDisk/Dir

You can also type into the terminal just the command:

rsync -a --progress --stats --human-readable
(note there needs to be one or more spaces after --human-readable to end that command and break before the source and destination file names are provided)

