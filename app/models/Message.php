<?php 
namespace App\Models;
use App\Systems\QueryBuilder;

class Message extends QueryBuilder
{
	protected string $defaultTable = 'messages';
}
