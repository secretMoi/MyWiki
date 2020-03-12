<?php


namespace Test\TabClass;


use Traversable;

class Collection implements \IteratorAggregate, \ArrayAccess
{
	private $items;

	public function __construct(array $items)
	{
		$this->items = $items;
	}

	/**
	 * retourne la valeur d'un élément
	 * @param $key
	 * @return bool|mixed
	 */
	public function get($key) {
		$index = explode('.', $key);

		return $this->getValue($index, $this->items);
	}

	private function getValue(array $indexes, $value) {
		$key = array_shift($indexes);

		if(empty($indexes)){
			if(!array_key_exists($key, $value))
				return null;
			if(is_array($value[$key]))
				return new Collection($value[$key]);

			return $value[$key];
		}


		return $this->getValue($indexes, $value[$key]);
	}

	/**
	 * assigne une value à une key
	 * @param $key
	 * @param $value
	 */
	public function set($key, $value) {
		$this->items[$key] = $value;
	}

	/**
	 * vérifié si une clé est bien présente dans un tableau
	 * @param $key
	 * @return bool
	 */
	public function has($key){
		return array_key_exists($key, $this->items);
	}

	public function lists($key, $value){
		$results = [];
		foreach ($this->items as $item){
			$results[$item[$key]] = $item[$value];
		}

		return new Collection($results);
	}

	public function extract($key){
		$results = [];
		foreach ($this->items as $item){
			$results[] = $item[$key];
		}

		return new Collection($results);
	}

	public function join($glue){
		return implode($glue, $this->items);
	}

	public function max($key = false) {
		if($key)
			return $this->extract($key)->max();

		return max($this->items);
	}

	/**
	 * Whether a offset exists
	 * @link https://php.net/manual/en/arrayaccess.offsetexists.php
	 * @param mixed $offset <p>
	 * An offset to check for.
	 * </p>
	 * @return boolean true on success or false on failure.
	 * </p>
	 * <p>
	 * The return value will be casted to boolean if non-boolean was returned.
	 * @since 5.0.0
	 */
	public function offsetExists($offset)
	{
		return $this->has($offset);
	}

	/**
	 * Offset to retrieve
	 * @link https://php.net/manual/en/arrayaccess.offsetget.php
	 * @param mixed $offset <p>
	 * The offset to retrieve.
	 * </p>
	 * @return mixed Can return all value types.
	 * @since 5.0.0
	 */
	public function offsetGet($offset)
	{
		return $this->get($offset);
	}

	/**
	 * Offset to set
	 * @link https://php.net/manual/en/arrayaccess.offsetset.php
	 * @param mixed $offset <p>
	 * The offset to assign the value to.
	 * </p>
	 * @param mixed $value <p>
	 * The value to set.
	 * </p>
	 * @return void
	 * @since 5.0.0
	 */
	public function offsetSet($offset, $value)
	{
		return $this->set($offset, $value);
	}

	/**
	 * Offset to unset
	 * @link https://php.net/manual/en/arrayaccess.offsetunset.php
	 * @param mixed $offset <p>
	 * The offset to unset.
	 * </p>
	 * @return void
	 * @since 5.0.0
	 */
	public function offsetUnset($offset)
	{
		if($this->has($offset))
			unset($this->items[$offset]);
	}

	/**
	 * Retrieve an external iterator
	 * @link https://php.net/manual/en/iteratoraggregate.getiterator.php
	 * @return Traversable An instance of an object implementing <b>Iterator</b> or
	 * <b>Traversable</b>
	 * @since 5.0.0
	 */
	public function getIterator()
	{
		return new \ArrayIterator($this->items);
	}
}