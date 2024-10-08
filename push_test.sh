excludes=(
  bitrix/license_key.php
  bitrix/.settings.php
  upload/
  .DS_Store
  .gitignore
  .htaccess
  bitrix/backup/
  bitrix/cache/
  bitrix/catalog_export
  .git/
  /bitrix/managed_cache
  /api
  /.vscode
  robots.txt
  .settings.php
)


Path_From=./
Path_To=frizar@frizar.beget.tech:./test.frizar.ru/public_html/

exclude_str="rsync -avz -e 'ssh -i ~/.ssh/id_rsa' $Path_From $Path_To"

for exclude in "${excludes[@]}"; do
    exclude_str+=" --exclude=$exclude "
done

eval $exclude_str
