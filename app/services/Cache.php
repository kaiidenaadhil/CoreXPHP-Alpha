<?php
class Cache {
    protected $cacheDir;
    protected $expiration;

    /**
     * Cache constructor.
     *
     * @param int $expiration - Cache expiration time in seconds.
     * @param string|null $cacheDir - Directory to store cache files (default: dynamic path).
     */
    public function __construct($expiration = 3600, $cacheDir = null) {
        // Set default cache directory to a dynamic path
        $this->cacheDir = $cacheDir ?: dirname(__DIR__) . '/cache/';
        $this->expiration = $expiration;

        // Create cache directory if it doesn't exist
        if (!is_dir($this->cacheDir)) {
            mkdir($this->cacheDir, 0755, true);
        }
    }

    /**
     * Retrieve a cached item by key.
     *
     * @param string $key - Unique key for the cached item.
     * @return mixed|null - The cached data or null if not found/expired.
     */
    public function get($key) {
        $filePath = $this->cacheDir . md5($key) . '.cache';
        if (file_exists($filePath) && (time() - filemtime($filePath) < $this->expiration)) {
            return unserialize(file_get_contents($filePath));
        }
        return null;
    }

    /**
     * Store an item in the cache.
     *
     * @param string $key - Unique key for the cached item.
     * @param mixed $data - The data to cache.
     */
    public function set($key, $data) {
        $filePath = $this->cacheDir . md5($key) . '.cache';
        file_put_contents($filePath, serialize($data));
    }

    /**
     * Delete a cached item.
     *
     * @param string $key - Unique key for the cached item.
     */
    public function delete($key) {
        $filePath = $this->cacheDir . md5($key) . '.cache';
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }
}
