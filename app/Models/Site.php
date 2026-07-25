<?php 
namespace App\Models;
use App\Systems\QueryBuilder;

class Site extends QueryBuilder
{
	protected string $defaultTable = 'sites';
}
