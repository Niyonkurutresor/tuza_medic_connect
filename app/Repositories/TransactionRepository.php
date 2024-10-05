<?php

namespace App\Repositories;

use App\Models\Transaction;

/**
 * Class RoleRepository
 *
 * @version August 5, 2021, 10:43 am UTC
 */
class TransactionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
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
        return Transaction::class;
    }

    public function show($id): array
    {
        $transaction['data'] = Transaction::with('user', 'appointment.doctor.user',
            'acceptedPaymentUser')->whereId($id)->first();

        return $transaction;
    }
}
