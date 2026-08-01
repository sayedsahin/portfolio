<?php
namespace App\Models;
use Bhitti\Database\QueryBuilder;

class Message extends QueryBuilder
{
	protected string $defaultTable = 'messages';
}
