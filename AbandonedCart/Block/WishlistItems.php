<?php
namespace Visionet\AbandonedCart\Block;

class WishlistItems extends \Magento\Framework\View\Element\Template
{
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Wishlist\Model\Wishlist $wishlist,
        array $data = []
    ) {
        $this->wishlist = $wishlist;
        parent::__construct($context,$data);
    }
    /**
    * @param int $customerId
    */
    public function getWishlistByCustomerId($customerId)
    {
        $wishlist = $this->wishlist->loadByCustomerId($customerId)->getItemCollection();

        return $wishlist;
    }
}