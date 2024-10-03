<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
    if(is_array($arResult["TABS"]) && count($arResult["TABS"])>0):?>

        <ul class="bxr-detail-tabs hidden-xxs"><?
            foreach ($arResult["TABS"] as $k => $tab):
                
                    if(empty($tab["name"]))
                            continue;
                    if($k == "props" && count($arResult["DISPLAY_PROPERTIES"])===0)
                            continue;
                //костыль для того что б не выводить отзывы в табах, а вывести их компонентом выше и при этом что б все работало            
                if ($tab["name"] != "Отзывы"):
                ?><li data-tab="<?=$k?>"><?=$tab["name"]?></li><?
                endif;
            endforeach;?>
        </ul>
		<div class="clearfix"></div><?
    endif;
