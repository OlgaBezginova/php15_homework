<?php

abstract class Application implements PrintableInterface
{
    protected $name;

    public function __construct(string $name)
    {
        if( !empty($name) ) {
            $this->name = $name;
        }
    }

    public function getName()
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        if( !empty($name) ) {
            $this->name = $name;
        }
    }

    public function getTitle() : string
    {
        return $this->name;
    }

    public function getDescription() : string
    {
        return __CLASS__;
    }

}

class ServiceApplication extends Application
{
    public function getDescription() : string
    {
        return 'a Service Application';
    }
}

class EntertainmentApplication extends Application
{
    public function getDescription() : string
    {
        return 'an Entertainment Application';
    }
}

class WorkApplication extends Application
{
    public function getDescription() : string
    {
        return 'a Work Application';
    }
}

class StoreItem implements BuyableInterface, PrintableInterface
{
    protected $product;
    protected $paymentType, $price;

    static $paymentTypesList = [
        self::FREE,
        self::OTP,
        self::SAAS,
        self::IAP,
        self::PR
    ];

    const FREE = "Free";
    const OTP = "One Time Payment";
    const SAAS = "Software as a Service";
    const IAP = "In App Purchases";
    const PR = "Premium OTP";

    public function __construct(object $product)
    {
        $this->product = $product;
    }

    public function setPaymentType(string $type) : void
    {
        if (in_array($type, self::$paymentTypesList)){
            $this->paymentType = $type;
        }
    }

    public function getPaymentType()
    {
        return $this->paymentType;
    }

    public function setPrice(float $price) : void
    {
        if( !empty($price) ) {
            $this->price = $price;
        }
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getDescription() : string
    {
        return $this->product->getDescription();
    }

    public function getTitle(): string
    {
        return $this->product->getTitle();
    }
}

class Store implements StoreInterface
{
    private $availableItems = [];
    private $purchasedItems = [];

    public function purchase($productName, $customer) : void
    {
        if(!key_exists($productName, $this->availableItems)) {
            return;
        }

        if(!key_exists($productName, $this->purchasedItems)) {
            $this->purchasedItems[$productName] = ['ammount' => 1, 'total' => $this->availableItems[$productName]->getPrice()];
        } else {
            $this->purchasedItems[$productName]['ammount']++;
            $this->purchasedItems[$productName]['total'] += $this->availableItems[$productName]->getPrice();
        }

        echo $customer->get_info() . ' has bought the ' . $productName . ' - ' . $this->availableItems[$productName]->getDescription() . PHP_EOL . PHP_EOL;
    }

    public function addToStore(object $product, string $type, float $price)
    {
        if(key_exists($product->getTitle(), $this->availableItems)) {
            return;
        }

        $storeItem = new StoreItem($product);
        $storeItem->setPaymentType($type);
        $storeItem->setPrice($price);

        if(!empty($storeItem->getPrice()) && !empty($storeItem->getPaymentType())){
            $this->availableItems[$product->getTitle()] = $storeItem;
        }

        return $this;
    }

    public function getCatalog() : string
    {
        if(empty($this->availableItems)) {
            return 'The catalog is empty';
        }

        $catalog = 'Catalog:' . PHP_EOL;
        foreach($this->availableItems as $itemName=>$item) {
            $catalog .= $itemName . ' - ' . $item->getPrice() . ' (' . $item->getPaymentType() . ')' . PHP_EOL;
        }
        return $catalog . PHP_EOL;
    }

    public function getPurchases() : string
    {
        if(empty($this->purchasedItems)) {
            return 'No purchases';
        }

        $purchases = 'Purchases:' . PHP_EOL;
        foreach($this->purchasedItems as $itemName=>$info) {
            $purchases .= $itemName . ' - ' . $info['ammount'] . ' (Total sum = ' . $info['total'] . ')' . PHP_EOL;
        }
        return $purchases;
    }

}

interface BuyableInterface
{
    public function setPaymentType(string $type) : void;
    public function setPrice(float $price) : void;
}

interface PrintableInterface
{
    public function getTitle() : string;
    public function getDescription() : string;
}

interface StoreInterface
{
    public function purchase(string $productName, Customer $customer) : void;
}

class Customer {

    public $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function get_info(){
        return $this->name;
    }

    public function buy(StoreInterface $store, $productName){
        $store->purchase($productName, $this);
    }
}

$appStore = new Store();

$appStore->addToStore(new ServiceApplication('Super Antivirus'), 'One Time Payment', 20)
    ->addToStore(new WorkApplication('Text Editor'), 'In App Purchases', 30)
    ->addToStore(new EntertainmentApplication('Some Game'), 'One Time Payment', 100)
    ->addToStore(new EntertainmentApplication('One More Game'), 'Software as a Service', 55)
    ->addToStore(new WorkApplication('Calculator'), 'Premium OTP', 9.99);

echo $appStore->getCatalog();

$customer = new Customer('John Doe');
$customer->buy($appStore, 'Calculator');
$customer->buy($appStore, 'Calculator');
$customer->buy($appStore, 'One More Game');

echo $appStore->getPurchases();