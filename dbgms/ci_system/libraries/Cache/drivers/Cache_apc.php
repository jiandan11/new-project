<?php
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP
 *
 * This content is released under the MIT License (MIT)
 *
 * Copyright (c) 2014 - 2015, British Columbia Institute of Technology
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @package	CodeIgniter
 * @author	EllisLab Dev Team
 * @copyright	Copyright (c) 2008 - 2014, EllisLab, Inc. (http://ellislab.com/)
 * @copyright	Copyright (c) 2014 - 2015, British Columbia Institute of Technology (http://bcit.ca/)
 * @license	http://opensource.org/licenses/MIT	MIT License
 * @link	http://codeigniter.com
 * @since	Version 2.0.0
 * @filesource
 */
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );

/**
 * CodeIgniter APC Caching Class
 *
 * @package CodeIgniter
 * @subpackage Libraries
 * @category Core
 * @author EllisLab Dev Team
 * @link
 *
 */
class CI_Cache_apc extends CI_Driver {
	
	/**
	 * Get
	 *
	 * Look for a value in the cache. If it exists, return the data
	 * if not, return FALSE
	 *
	 * @param
	 *        	string
	 * @return mixed that is stored/FALSE on failure
	 */
	public function get($id)
	{
		$success = FALSE;
		$data = apc_fetch ( $id, $success );
		
		if($success === TRUE)
		{
			return is_array ( $data ) ? unserialize ( $data[0] ) : $data;
		}
		
		return FALSE;
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Cache Save
	 *
	 * @param string $id        	
	 * @param mixed $data
	 *        	store
	 * @param int $ttol
	 *        	time (in seconds) to cache the data
	 * @param bool $raw
	 *        	store the raw value
	 * @return bool on success, FALSE on failure
	 */
	public function save($id, $data, $ttl = 60, $raw = FALSE)
	{
		$ttl = ( int ) $ttl;
		
		return apc_store ( $id, ($raw === TRUE ? $data : array(
				serialize ( $data ),
				time (),
				$ttl 
		)), $ttl );
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Delete from Cache
	 *
	 * @param
	 *        	mixed unique identifier of the item in the cache
	 * @return bool on success/false on failure
	 */
	public function delete($id)
	{
		return apc_delete ( $id );
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Increment a raw value
	 *
	 * @param string $id        	
	 * @param int $offset
	 *        	add
	 * @return mixed value on success or FALSE on failure
	 */
	public function increment($id, $offset = 1)
	{
		return apc_inc ( $id, $offset );
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Decrement a raw value
	 *
	 * @param string $id        	
	 * @param int $offset
	 *        	reduce by
	 * @return mixed value on success or FALSE on failure
	 */
	public function decrement($id, $offset = 1)
	{
		return apc_dec ( $id, $offset );
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Clean the cache
	 *
	 * @return bool on failure/true on success
	 */
	public function clean()
	{
		return apc_clear_cache ( 'user' );
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Cache Info
	 *
	 * @param
	 *        	string user/filehits
	 * @return mixed on success, false on failure
	 */
	public function cache_info($type = NULL)
	{
		return apc_cache_info ( $type );
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * Get Cache Metadata
	 *
	 * @param
	 *        	mixed key to get cache metadata on
	 * @return mixed on success/false on failure
	 */
	public function get_metadata($id)
	{
		$success = FALSE;
		$stored = apc_fetch ( $id, $success );
		
		if($success === FALSE or count ( $stored ) !== 3)
		{
			return FALSE;
		}
		
		list($data,$time,$ttl) = $stored;
		
		return array(
				'expire' => $time + $ttl,
				'mtime' => $time,
				'data' => unserialize ( $data ) 
		);
	}
	
	// ------------------------------------------------------------------------
	
	/**
	 * is_supported()
	 *
	 * Check to see if APC is available on this system, bail if it isn't.
	 *
	 * @return bool
	 */
	public function is_supported()
	{
		if(! extension_loaded ( 'apc' ) or ! ini_get ( 'apc.enabled' ))
		{
			log_message ( 'debug', 'The APC PHP extension must be loaded to use APC Cache.' );
			return FALSE;
		}
		
		return TRUE;
	}
}
