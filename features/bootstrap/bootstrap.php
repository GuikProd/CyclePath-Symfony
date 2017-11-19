<?php

declare(strict_types=1);

/*
 * This file is part of the CyclePath project.
 *
 * (c) Guillaume Loulier <contact@guillaumeloulier.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Symfony\Component\Dotenv\Dotenv;

// The check is to ensure we don't use .env in production
if (!isset($_SERVER['APP_ENV'])) {
    (new Dotenv())->load(__DIR__.'/../../.env');
}
