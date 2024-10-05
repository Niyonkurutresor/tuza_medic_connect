<?php

namespace App\Repositories;

use App\Models\Role;
use App\Models\Staff;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

/**
 * Class StaffRepository
 *
 * @version August 6, 2021, 10:17 am UTC
 */
class StaffRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'password',
        'gender',
        'role',
    ];

    /**
     * Return searchable fields
     */
    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Staff::class;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        $roles = Role::pluck('display_name', 'id')->except([User::ADMIN, User::DOCTOR, User::PATIENT]);

        return $roles;
    }

    public function store($input): bool
    {
        try {
            DB::beginTransaction();

            $input['email'] = setEmailLowerCase($input['email']);
            $input['password'] = Hash::make($input['password']);
            $input['type'] = User::STAFF;
            $staff = User::create($input);

            if (isset($input['role']) && ! empty($input['role'])) {
                $role = $staff->assignRole($input['role']);
                $role->givePermissionTo('manage_admin_dashboard');
            }

            if (isset($input['profile']) && ! empty($input['profile'])) {
                $staff->addMedia($input['profile'])->toMediaCollection(Staff::PROFILE, config('app.media_disc'));
            }

            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }

    public function update($input, $id)
      {
        try {
            DB::beginTransaction();

            $staff = User::find($id);
            $input['email'] = setEmailLowerCase($input['email']);
            if (isset($input['password']) && ! empty($input['password'])) {
                $input['password'] = Hash::make($input['password']);
            } else {
                unset($input['password']);
            }

            $input['type'] = User::STAFF;
            $staff->update($input);
            if (isset($input['role']) && ! empty($input['role'])) {
                $staff->syncRoles($input['role']);
            }

            if (isset($input['profile']) && ! empty($input['profile'])) {
                $staff->clearMediaCollection(Staff::PROFILE);
                $staff->media()->delete();
                $staff->addMedia($input['profile'])->toMediaCollection(Staff::PROFILE, config('app.media_disc'));
            }

            DB::commit();

            return true;
        } catch (Exception $e) {
            DB::rollBack();
            throw new UnprocessableEntityHttpException($e->getMessage());
        }
    }
}
