<?php

/**
 * LRU Cache
 */
class LRUCache
{
	private $cache;
	private $size;
	
	function __construct($size)
	{
		$this->cache = [];
		$this->size = $size;
	}

	public function put($item)
	{

		if (in_array($item, $this->cache)) {

			// array_diff: remove the [$item] from $this->cache array.
			$this->cache = array_diff($this->cache, [$item]);
		}
		else if ($this->isFull())
		{
			// array_pop: Remove the last element from the cache array
			array_pop($this->cache);
		}

		array_unshift($this->cache, $item);
	}

	public function display()
    {
        var_dump($this->cache);
    }

    private function isFull()
    {
        if(count($this->cache) >= $this->size)
        {
            return true;
        } 
    }
}

$cache_size = 5;
$entries = ['A','B','A','C','B','A'];

$cache = new LRUCache($cache_size);
$cache->display();

foreach($entries as $entry)
{
    $cache->put($entry);
}

$cache->display();

?>