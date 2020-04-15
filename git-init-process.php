////////////////////////////////
/// Create empty repository:////
////////////////////////////////
git init

Check changes:
git status

Add all changes and files:
git add .

Commit all files and changes:
git commit -m 'Initial commit'

Create new repository on github account and copy clone path/url:
Now add new remote origin:
git remote add origin "clone_url_without_qoutes"

Check remote origin congif:
git remote -v 

Set upstream-branch:
git push --set-upstream origin master
git branch --set-upstream-to=origin/master

Now pull from repository:
git pull 
OR
git pull --allow-unrelated-histories

Type ":q" and hit enter

Now push repository:
git push

////////////////////////////////
/// Create and manage branch: //
////////////////////////////////

Create new branch:
git branch "branch_name_without_qoutes"

Show all branches:
git branch --list
OR 
git branch

Changing branch:
git checkout "branch_name_to_switch_without_qoutes" 

Create new branch and switch directly newly created branch:
git checkout -b "branch_name_without_qoutes"

First time push changes into newly created branch:
git push --set-upstream origin "branch_name_without_qoutes"


/////////////////////
/// Merge branch: ///
/////////////////////

Switch to branch on which you want to merge:
git checkout "branch_name_to_switch_without_qoutes"  // eg: git checkout master

git merge "branch_name_to_merge_without_qoutes" // eg: git merge alpha
Type ":q" and hit enter
Now commit and push to current branch


//////////////////////
/// Delete branch: ///
//////////////////////

git branch -d "branch_name_without_qoutes" // This will delete only local not remote

git push origin :"deleted_branch_name_without_qoutes"


https://www.youtube.com/playlist?list=PL-osiE80TeTuRUfjRe54Eea17-YfnOOAx

