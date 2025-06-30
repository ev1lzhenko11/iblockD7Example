<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<table style="border: solid 1px black;">
    <tr>
        <td>ФИО</td>
        <td>Город</td>
        <td>Улица</td>
        <td>Номер</td>
    </tr>
    <?foreach ($arResult['ITEMS'] as $item){?>
        <tr>
            <td style="border: solid 1px black;"><?=$item['IBLOCK_ELEMENTS_ELEMENT_RESIDENTS_PROPERTY_FIO_VALUE']?></td>
            <td style="border: solid 1px black;"><?=$arResult['ITEMS_HOUSES'][$item['IBLOCK_ELEMENTS_ELEMENT_RESIDENTS_PROPERTY_HOME_IBLOCK_GENERIC_VALUE']]['IBLOCK_ELEMENTS_ELEMENT_HOUSES_PROPERTY_CITY_VALUE']?></td>
            <td style="border: solid 1px black;"><?=$arResult['ITEMS_HOUSES'][$item['IBLOCK_ELEMENTS_ELEMENT_RESIDENTS_PROPERTY_HOME_IBLOCK_GENERIC_VALUE']]['IBLOCK_ELEMENTS_ELEMENT_HOUSES_PROPERTY_STREET_VALUE']?></td>
            <td style="border: solid 1px black;"><?=$arResult['ITEMS_HOUSES'][$item['IBLOCK_ELEMENTS_ELEMENT_RESIDENTS_PROPERTY_HOME_IBLOCK_GENERIC_VALUE']]['IBLOCK_ELEMENTS_ELEMENT_HOUSES_PROPERTY_NUMBER_VALUE']?></td>
        </tr>
    <?}?>
</table>

<?php
$APPLICATION->IncludeComponent(
    'bitrix:main.pagenavigation',
    'grid',
    array(
        'NAV_OBJECT' => $arResult['NAV_OBJECT'],
        'SEF_MODE' => 'N',
    ),
    false
);
?>