<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
$bDelayColumn  = false;
$bDeleteColumn = false;
$bWeightColumn = false;
$bPropsColumn  = false;
?>
<div id="basket_items_delayed" class="boo bx_ordercart_order_table_container" style="display:none">
	<table id="delayed_items">
		<thead>
			<tr>
				<td class="margin"></td>
				<?
				foreach ($arResult["GRID"]["HEADERS"] as $id => $arHeader):
					$arHeader["name"] = (isset($arHeader["name"]) ? (string)$arHeader["name"] : '');
					if ($arHeader["name"] == '')
						$arHeader["name"] = GetMessage("SALE_".$arHeader["id"]);
					if (in_array($arHeader["id"], array("TYPE"))) // some header columns are shown differently
					{
						continue;
					}
					elseif ($arHeader["id"] == "PROPS")
					{
						$bPropsColumn = true;
						continue;
					}
					elseif ($arHeader["id"] == "DELAY")
					{
						continue;
					}
					elseif ($arHeader["id"] == "DELETE")
					{
						$bDeleteColumn = true;
						continue;
					}
					elseif ($arHeader["id"] == "WEIGHT")
					{
						$bWeightColumn = true;
					}

					if ($arHeader["id"] == "NAME"):
					?>
						<td class="item" colspan="2">
					<?
					elseif ($arHeader["id"] == "PRICE"):
					?>
						<td class="price">
					<?
					else:
					?>
						<td class="custom">
					<?
					endif;
					?>
						<?=$arHeader["name"]; ?>
						</td>
				<?
				endforeach;

				if ($bDeleteColumn || $bDelayColumn):
				?>
					<td class="custom"></td>
				<?
				endif;
				?>
					<td class="margin"></td>
			</tr>
		</thead>

		<tbody>
			<?
			foreach ($arResult["GRID"]["ROWS"] as $k => $arItem):

				if ($arItem["DELAY"] == "Y" && $arItem["CAN_BUY"] == "Y"):
			?>
				<tr id="<?=$arItem["ID"]?>">
					<td class="margin"></td>
					<?
					foreach ($arResult["GRID"]["HEADERS"] as $id => $arHeader):

						if (in_array($arHeader["id"], array("PROPS", "DELAY", "DELETE", "TYPE"))) // some values are not shown in columns in this template
							continue;

						if ($arHeader["id"] == "NAME"):
						?>
							<td class="itemphoto">
								<div class="bx_ordercart_photo_container">
									<?
									if (strlen($arItem["PREVIEW_PICTURE_SRC"]) > 0):
										$url = $arItem["PREVIEW_PICTURE_SRC"];
									elseif (strlen($arItem["DETAIL_PICTURE_SRC"]) > 0):
										$url = $arItem["DETAIL_PICTURE_SRC"];
									else:
										$url = $templateFolder."/images/no_photo.png";
									endif;
									?>
									<?if (strlen($arItem["PARENT"]["DETAIL_PAGE_URL"]) > 0):?><a href="<?=$arItem["PARENT"]["DETAIL_PAGE_URL"] ?>">
                                                                        <?elseif (strlen($arItem["DETAIL_PAGE_URL"]) > 0):?><a href="<?=$arItem["DETAIL_PAGE_URL"] ?>"><?endif;?>
                                                                            <img src="<?=$url?>" title="<?=$arItem["NAME"]?>" alt="<?=$arItem["NAME"]?>">
									<?if (strlen($arItem["PARENT"]["DETAIL_PAGE_URL"]) > 0 || strlen($arItem["DETAIL_PAGE_URL"]) > 0):?></a><?endif;?>
								</div>
								<?
								if (!empty($arItem["BRAND"])):
								?>
								<div class="bx_ordercart_brand">
									<img alt="" src="<?=$arItem["BRAND"]?>" />
								</div>
								<?
								endif;
								?>
							</td>

							<td class="item">
								<h2 class="bx_ordercart_itemtitle">
									<?if (strlen($arItem["PARENT"]["DETAIL_PAGE_URL"]) > 0):?><a href="<?=$arItem["PARENT"]["DETAIL_PAGE_URL"] ?>">
                                                                        <?elseif (strlen($arItem["DETAIL_PAGE_URL"]) > 0):?><a href="<?=$arItem["DETAIL_PAGE_URL"] ?>"><?endif;?>
										<?=$arItem["NAME"]?>
									<?if (strlen($arItem["PARENT"]["DETAIL_PAGE_URL"]) > 0 || strlen($arItem["DETAIL_PAGE_URL"]) > 0):?></a><?endif;?>
								</h2>
								<div class="bx_ordercart_itemart">
									<?
									if ($bPropsColumn):
										foreach ($arItem["PROPS"] as $val):

											if (is_array($arItem["SKU_DATA"]))
											{
												$bSkip = false;
												foreach ($arItem["SKU_DATA"] as $propId => $arProp)
												{
													if ($arProp["CODE"] == $val["CODE"])
													{
														$bSkip = true;
														break;
													}
												}
												if ($bSkip)
													continue;
											}

											echo $val["NAME"].":&nbsp;<span>".$val["VALUE"]."<span><br/>";
										endforeach;
									endif;
									?>
								</div>
								<input type="hidden" name="DELAY_<?=$arItem["ID"]?>" value="Y"/>
							</td>
						<?
						elseif ($arHeader["id"] == "QUANTITY"):
						?>
							<td class="custom">
                                                                <span class="hidden-xs"><?=$arHeader["name"]; ?>:</span>
                                                                <span class="hidden-lg hidden-md hidden-sm"><?=GetMessage("SALE_".$arHeader["id"]);?>:</span>
								<div style="text-align: center;">
									<?echo $arItem["QUANTITY"];
										if (isset($arItem["MEASURE_TEXT"]))
											echo "&nbsp;".$arItem["MEASURE_TEXT"];
									?>
								</div>
							</td>
						<?
						elseif ($arHeader["id"] == "PRICE"):
						?>
							<td class="price">
                                                                <span class="hidden-lg hidden-md hidden-sm"><?=GetMessage("SALE_".$arHeader["id"]);?>:</span>
								<?if (doubleval($arItem["DISCOUNT_PRICE_PERCENT"]) > 0):?>
									<div class="current_price"><?=$arItem["PRICE_FORMATED"]?></div>
									<div class="old_price"><?=$arItem["FULL_PRICE_FORMATED"]?></div>
								<?else:?>
									<div class="current_price"><?=$arItem["PRICE_FORMATED"];?></div>
								<?endif?>

								<?if (strlen($arItem["NOTES"]) > 0):?>
									<div class="type_price"><?=GetMessage("SALE_TYPE")?></div>
									<div class="type_price_value"><?=$arItem["NOTES"]?></div>
								<?endif;?>
							</td>
						<?
						elseif ($arHeader["id"] == "DISCOUNT"):
						?>
                                                    <?if($arItem["DISCOUNT_PRICE_PERCENT_FORMATED"]):?>
							<td class="custom">
                                                                <span class="hidden-xs"><?=$arHeader["name"]; ?>:</span>
                                                                <span class="hidden-lg hidden-md hidden-sm"><?=GetMessage("SALE_".$arHeader["id"]);?>:</span>
                                                                <div><?=$arItem["DISCOUNT_PRICE_PERCENT_FORMATED"]?></div>
							</td>
                                                    <?endif;?>
						<?
						elseif ($arHeader["id"] == "WEIGHT"):
						?>
							<td class="custom">
                                                                <span class="hidden-xs"><?=$arHeader["name"]; ?>:</span>
                                                                <span class="hidden-lg hidden-md hidden-sm"><?=GetMessage("SALE_".$arHeader["id"]);?>:</span>
								<?=$arItem["WEIGHT_FORMATED"]?>
							</td>
						<?
						else:
						?>
							<td class="custom">
                                                                <span class="hidden-xs"><?=$arHeader["name"]; ?>:</span>
                                                                <span class="hidden-lg hidden-md hidden-sm"><?=GetMessage("SALE_".$arHeader["id"]);?>:</span>
								<?
                                                                if ($arHeader["id"] == "SUM"):
                                                                ?>
                                                                        <div id="sum_<?=$arItem["ID"]?>">
                                                                <?
                                                                endif;

                                                                echo $arItem[$arHeader["id"]];

                                                                if ($arHeader["id"] == "SUM"):
                                                                ?>
                                                                        </div>
                                                                <?
                                                                endif;
                                                                ?>
							</td>
						<?
						endif;
					endforeach;

					if ($bDelayColumn || $bDeleteColumn):
					?>
						<td class="control">
							<a class="bxr-icon-baske-delay-big-baske" href="<?=str_replace("#ID#", $arItem["ID"], $arUrls["add"])?>" title="<?=GetMessage("SALE_ADD_TO_BASKET")?>"><span class="fa fa-shopping-cart" aria-hidden="true"></span></a>
							<?
							if ($bDeleteColumn):
							?>
								<a class="bxr-icon-button-delete-big-baske"  href="<?=str_replace("#ID#", $arItem["ID"], $arUrls["delete"])?>" title="<?=GetMessage("SALE_DELETE")?>"><span class="fa fa-close" aria-hidden="true"></span></a><br />
							<?
							endif;
							?>
						</td>
					<?
					endif;
					?>
						<td class="margin"></td>
				</tr>
				<?
				endif;
			endforeach;
			?>
		</tbody>

	</table>
</div>
<?