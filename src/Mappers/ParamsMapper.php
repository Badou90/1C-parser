<?php

namespace Badou\Parser\Mappers;

use Badou\Parser\Contracts\ParamsMapperInterface;
use App\Models\CatalogItem;

class ParamsMapper implements ParamsMapperInterface
{
    protected $prices;

    const DEALER_PRICE = "Дилер";
    const PRICE = "Розница";

    public function parse($offer)
    {
        foreach ($offer->ПакетПредложений->ТипыЦен->ТипЦены as $priceType) {
            $this->prices[(String)$priceType->Ид] = (String)$priceType->Наименование;
        }

        foreach ($offer->ПакетПредложений->Предложения->Предложение as $offerItem) {
            $catalogItem = CatalogItem::where('code', $offerItem->Ид)->first();
            $offerItemPrices = $this->getPrices($offerItem);

            if($catalogItem){
                $catalogItem->update([
                    'price' => (isset($offerItemPrices[self::PRICE]))?$offerItemPrices[self::PRICE]:0,
                    'price_dealer' => (isset($offerItemPrices[self::DEALER_PRICE]))?$offerItemPrices[self::DEALER_PRICE]:0,
                ]);
            }
        }
    }

    public function getPrices($item)
    {
        foreach($item->Цены->Цена as $priceType) {
            $prices[$this->prices[(String)$priceType->ИдТипаЦены]] = (int)$priceType->ЦенаЗаЕдиницу;
        }
        return $prices;
    }
}
