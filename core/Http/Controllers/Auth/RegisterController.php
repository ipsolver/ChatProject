<?php


namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use App\Services\UserRegistrationService;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Contracts\Validation\Validator as ValidationContract;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Exception\HttpException;
use function report;
use Throwable;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected string $redirectTo = RouteServiceProvider::HOME;

    protected UserRegistrationService $registrationService;

    public function __construct(UserRegistrationService $registrationService)
    {
        $this->middleware('guest');
        $this->registrationService = $registrationService;
    }

    protected function validator(array $data): ValidationContract
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255', 'regex:/^[a-zA-Z\s]+$/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data): User
    {
        try {
            return DB::transaction(function () use ($data) {
                return $this->registrationService->registerUser($data);
            });
        } catch (Throwable $e) {
            report($e);
            throw new HttpException(500, 'Registration failed. Please try again later.');
        }
    }
}