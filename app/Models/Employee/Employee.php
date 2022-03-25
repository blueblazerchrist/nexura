<?php

namespace App\Models\Employee;

use App\Models\Department\Department;
use App\Models\Role\Role;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method static paginate(int $int)
 * @property mixed $name
 * @property mixed $id
 * @property mixed $email
 * @property mixed $gender
 * @property mixed $department_id
 * @property mixed $newsletter
 * @property mixed $description
 */
class Employee extends Model
{
    use HasFactory;

    protected $with = ['roles'];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'gender',
        'department_id',
        'newsletter',
        'description',
    ];

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'roles_has_employees', 'employee_id', 'role_id');
    }

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

}
