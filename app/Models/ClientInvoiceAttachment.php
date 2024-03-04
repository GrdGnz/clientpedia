<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientInvoiceAttachment extends Model
{
    use HasFactory;

    protected $table = 'client_invoice_attachments';

    protected $fillable = [
        'client_id',
        'schedule',
        'description_path',
        'email_approval_path',
        'purchase_order_path',
        'remarks',
        'status_id',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');
    }
}
