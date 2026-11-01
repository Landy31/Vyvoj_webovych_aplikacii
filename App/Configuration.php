<?php

namespace App;

use Framework\Auth\DummyAuthenticator;
use Framework\Core\ErrorHandler;
use Framework\DB\DefaultConventions;

/** Main application configuration. */
class Configuration
{
    public const APP_NAME = 'E-Clothing';
    public const FW_VERSION = '3.0.7';

    // Kept from the Vaííčko starter configuration. This assignment does not use the DB.
    public const DB_HOST = 'db';
    public const DB_NAME = 'vaiicko_db';
    public const DB_USER = 'vaiicko_user';
    public const DB_PASS = 'dtb456';

    // Use the shared E-Clothing admin layout for every view unless a view overrides it.
    public const ROOT_LAYOUT = 'admin';

    public const SHOW_SQL_QUERY = false;
    public const DB_CONVENTIONS_CLASS = DefaultConventions::class;
    public const SHOW_EXCEPTION_DETAILS = true;
    public const LOGIN_URL = '?c=auth&a=login';
    public const AUTH_CLASS = DummyAuthenticator::class;
    public const ERROR_HANDLER_CLASS = ErrorHandler::class;
    public const UPLOAD_DIR = 'uploads' . DIRECTORY_SEPARATOR;
    public const UPLOAD_URL = '/uploads/';
    public const MODEL_REQUIRE_FILLABLE = true;
    public const CONTENT_SECURITY_POLICY = null;
    public const CONTENT_SECURITY_POLICY_REPORT_ONLY = true;
    public const IDENTITY_SESSION_KEY = 'fw.session.user.identity';
}
