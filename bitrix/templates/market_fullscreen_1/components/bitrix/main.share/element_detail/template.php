<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$this->setFrameMode(true);
if ($arResult["PAGE_URL"])
{
	?>
	<ul class="bxr-share-social">
		<?
		if (is_array($arResult["BOOKMARKS"]) && count($arResult["BOOKMARKS"]) > 0)
		{
			foreach(array_reverse($arResult["BOOKMARKS"]) as $name => $arBookmark)
			{
				?><li class="bxr-share-icon"><?=$arBookmark["ICON"]?></li><?
			}
		}
		?>
	</ul>
	<?
}
else
{
	?><?=GetMessage("SHARE_ERROR_EMPTY_SERVER")?><?
}
?>