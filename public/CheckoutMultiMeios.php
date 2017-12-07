<?php
/*
* Chechout MultiMeios Mundipagg
* @author Fabio Gonzaga
* 
*/
class CheckoutMundipagg implements JsonSerializable 
{

	/**
	* @var $items array
	*/
	private $items = array();

	/**
	* @var $customer array
	*/
	private $customer = array();

	/**
	* @var $payments array
	*/
	private $payments = array();

	/**
	* Limit Multi Credit Cards
	* @var $limit integer
	*/
	public $limit = 5;

	/**
	* @var $ip string
	*/
	private $ip;

	/**
	* @var $device object
	*/
	private $device;

	/**
	* Constructor to set initial or default values of member properties
	*/
	public function __construct()
	{
		$this->device->plataform	= PHP_OS;
		$this->ip					= $_SERVER['HTTP_CLIENT_IP'];
	}

	/**
	* @param $code string
	* @param $amount integer
	* @param $description string
	* @param $quantity integer
	*/
	public function setItems($code, $amount, $description, $quantity)
	{	
		$this->items[] = array(
			// 'code'			=> $code,
			'amount' 		=> $amount,
			'description' 	=> $description,
			'quantity' 		=> $quantity
		);	
	}

	/**
	* @return $this->items
	*/
	public function getItems()
	{
		if (!empty($this->items)) 
		{
			return json_encode($this->items);
		}
	}

	/**
	* @source https://docs.mundipagg.com/v1/reference#criar-cliente
	* @param $customer array See the official documentation in: https://docs.mundipagg.com/v1/reference#criar-cliente
	* @return $this->customer
	*/
	public function setCustomer(array $customer)
	{
		$this->customer = $customer;
	}

	/**
	* @return $this->customer
	*/
	public function getCustomer()
	{
		if (!empty($this->customer))
		{
			return json_encode($this->customer);	
		}
	}

	/**
	* Only credit card
	* @param $amount integer
	* @param $card array
	*/
	public function setPayments($amount, array $card, $statement_descriptor, $installments)
	{
		if (count($this->payments) <= $this->limit) 
		{
			$credit_card->recurrence			= false;
			$credit_card->installments			= $installments;
			$credit_card->statement_descriptor 	= $statement_descriptor;
			$credit_card->card 					= (object) $card; 

			$this->payments[] = array(
				'amount' 			=> $amount,
				'payment_method'	=> 'credit_card',
				'credit_card'		=> $credit_card
			);
		} else {
			return false;
		}
	}

	/**
	* @return $this->payments
	*/
	public function getPayments()
	{
		return json_encode($this->payments);
	}

	/**
     * Encode this object to JSON
     */
    public function jsonSerialize()
    {
        return [
            'items' 	=> $this->items,
            'ip'		=> $this->ip,
            'device'	=> $this->device,
            'customer' 	=> $this->customer,
            'payments' 	=> $this->payments
        ];
    }

}