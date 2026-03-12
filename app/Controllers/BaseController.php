<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

class BaseController extends Controller
{
    /**
     * Automatically loaded helpers
     */
    protected $helpers = ['form', 'url'];

    /**
     * Session & Database instances
     */
    protected $session;
    protected $db;

    /**
     * Constructor
     */
    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ) {
        parent::initController($request, $response, $logger);

        // Start session properly
        $this->session = \Config\Services::session();

        // Ensure session is started
        if (!isset($_SESSION)) {
            $this->session->start();
        }

        // Load database connection
        $this->db = \Config\Database::connect();
    }
}