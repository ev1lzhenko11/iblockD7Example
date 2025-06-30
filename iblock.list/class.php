<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
use Bitrix\Main\SystemException;
use Bitrix\Main\Loader;
use Bitrix\Main\UI\PageNavigation;

class CIblocList extends CBitrixComponent
{
    public function executeComponent()
    {
        try {
            $this->checkModules();
            $this->getResult();
        } catch (SystemException $e) {
            ShowError($e->getMessage());
        }
    }

    public function onIncludeComponentLang()
    {
        Loc::loadMessages(__FILE__);
    }

    protected function checkModules()
    {
        if (!Loader::includeModule('iblock'))
            throw new SystemException(Loc::getMessage('IBLOCK_MODULE_NOT_INSTALLED'));
    }

    public function onPrepareComponentParams($arParams)
    {
        return $arParams;
    }

    protected function getResult()
    {
            $nav = new PageNavigation('page');
            $this->arParams['PAGE_LIMIT'] = $this->arParams['PAGE_LIMIT'] ? $this->arParams['PAGE_LIMIT'] : 10;
            $nav->setPageSize($this->arParams['PAGE_LIMIT']);
            $nav->initFromUri();

            $res = \Bitrix\Iblock\Elements\ElementResidentsTable::getList([
                'select' => ["ID", "NAME", "PROPERTY_HOME", "PROPERTY_FIO"],
                "filter" => ["ACTIVE" => "Y"],
                "order" => ["SORT" => "ASC"],
                "limit" => $nav->getLimit(),
                "offset" => $nav->getOffset(),
                "count_total" => true
            ]);

            $nav->setRecordCount($res->getCount());

            while ($arItem = $res->fetch()) {
                $this->arResult['ITEMS'][] = $arItem;
            }

            $this->arResult['NAV_OBJECT'] = $nav;

            $idHouses = [];

            foreach ($this->arResult['ITEMS'] as $item) {
                $idHouses[$item['IBLOCK_ELEMENTS_ELEMENT_RESIDENTS_PROPERTY_HOME_IBLOCK_GENERIC_VALUE']] = $item['IBLOCK_ELEMENTS_ELEMENT_RESIDENTS_PROPERTY_HOME_IBLOCK_GENERIC_VALUE'];
            }

            $res = \Bitrix\Iblock\Elements\ElementHousesTable::getList([
                'select' => ["ID", "NAME", "PROPERTY_STREET", "PROPERTY_NUMBER", "PROPERTY_CITY"],
                "filter" => ["ID" => $idHouses, 'ACTIVE' => 'Y'],
            ]);

            while ($arItem = $res->fetch()) {
                $this->arResult['ITEMS_HOUSES'][$arItem['ID']] = $arItem;
            }

            $this->IncludeComponentTemplate();
    }
}
