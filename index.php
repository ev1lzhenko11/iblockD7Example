<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/header.php");?>

<?$APPLICATION->IncludeComponent(
   "test:iblock.list",
   ".default",
   [
      "PAGE_LIMIT" => 2
   ]
);?>

<?require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/footer.php");?>