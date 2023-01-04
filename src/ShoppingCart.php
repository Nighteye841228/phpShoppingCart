<?php

namespace Nighteye1228\PhpTestShopping;

class ShoppingCart
{
  private int $totalAmount;
  private int $totalPrice;
  private $itemAmountMap;
  private $itemPriceMap;


  /**
   * 初始化商品價格與商品數量對應陣列
   */
  public function __construct()
  {
    $this->itemAmountMap = [];
    $this->itemPriceMap = [];
  }

  /**
   * 第一次加入新商品需要指定商品價格，後續則不用（預設同一商品的價格相同）
   * 
   * @param string $itemName
   * @param int $price
   */

  public function addItem($itemName, $price = null)
  {
    if (!isset($itemName)) {
      return $this;
    }

    if (key_exists($itemName, $this->itemAmountMap)) {
      $this->itemAmountMap[$itemName]++;
    } else {
      if (!isset($price) || is_nan($price)) {
        return $this;
      }

      $this->itemAmountMap[$itemName] = 1;
      $this->itemPriceMap[$itemName] = $price;
    }

    return $this;
  }

  public function getTotalAmount()
  {
    $this->totalAmount = array_reduce($this->itemAmountMap, function ($old, $new) {
      return $old + $new;
    }, 0);
    return $this->totalAmount;
  }

  public function getTotalPrice()
  {
    $result = 0;
    array_map(function ($key, $amount) use (&$result) {
      $result += $amount * $this->itemPriceMap[$key];
      return 0;
    }, array_keys($this->itemAmountMap), array_values($this->itemAmountMap));
    $this->totalPrice = $result;
    return $this->totalPrice;
  }
}
