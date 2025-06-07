<?php  namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\SportPayment;
use App\Models\User;
use Carbon\Carbon;

class UpdateUserPaymentStatus extends Command
{
    protected $signature = 'update:user-payment-status {user_id?}';
    protected $description = 'Update user payment_status based on fee schedules';
// public function handle()
// {
//     $payments = SportPayment::all();

//     foreach ($payments as $payment) {
//         $data = json_decode($payment->fee_heads_durations, true) ?? [];
//         // dd($data);
//         $allPaid = false;

//        foreach ($data as $feeHead => $feeData) {
//     foreach ($feeData['schedule'] as $entry) {
//         try {
//             $dueDate = $this->parseDueDate($entry['due_date']);
//         } catch (\Exception $e) {
//             $this->error("Invalid date format for user_id {$payment->user_id} in fee head '{$feeHead}': {$entry['due_date']}");
//             continue 2;
//         }

//         $status = strtolower($entry['status']);
//         if ($status == 'paid' && Carbon::now()->lessThan($dueDate) && Carbon::()->lessThan($dueDate) ) {
//             $allPaid = true;
//             break 2;
//         }
//     }
// }


//         $payment->payment_status = $allPaid ? 'Paid' : 'Pending';
//         $payment->save();   

//         $user = User::find($payment->user_id);
//         if ($user) {
//             $user->payment_status = $allPaid ? 'paid' : 'pending';
//             $user->save();
//         }
//     }

//     $this->info('User and payment statuses updated successfully!');
// }

public function handle()
{
    $payments = SportPayment::all();

    foreach ($payments as $payment) {
        $data = json_decode($payment->fee_heads_durations, true) ?? [];
        $currentMonthPaid = false;

        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();

        foreach ($data as $feeHead => $feeData) {
            $schedule = $feeData['schedule'] ?? [];
            $found = false;

            foreach ($schedule as $entry) {
                try {
                    $dueDate = $this->parseDueDate($entry['due_date']);
                } catch (\Exception $e) {
                    $this->error("Invalid date format for user_id {$payment->user_id} in fee head '{$feeHead}': {$entry['due_date']}");
                    continue 2;
                }

                // Check if due date falls in current month
                if ($dueDate->betweenIncluded($startOfMonth, $endOfMonth)) {
                    $found = true;
                    $status = strtolower($entry['status'] ?? '');

                    if ($status !== 'paid') {
                        $currentMonthPaid = false;
                    }

                    break; // Check only one entry per fee head per month
                }
            }

            // If current month fee not found for any head, it's unpaid
            if ($found) {
                $currentMonthPaid = true;
                break;
            }

            // If found but unpaid
            if (!$currentMonthPaid) {
                break;
            }
        }

        $payment->payment_status = $currentMonthPaid ? 'paid' : 'pending';
        $payment->save();

        $user = User::find($payment->user_id);
        if ($user) {
            $user->payment_status = $currentMonthPaid ? 'paid' : 'pending';
            $user->save();
        }
    }

    $this->info('User and payment statuses updated successfully!');
}

protected function parseDueDate(string $date)
{
    $formats = ['d/m/Y', 'Y-m-d'];

    foreach ($formats as $format) {
        try {
            return Carbon::createFromFormat($format, $date);
        } catch (\Exception $e) {
            
        }
    }

    throw new \Exception("Invalid date format: {$date}");
}

}


