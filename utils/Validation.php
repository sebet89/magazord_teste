<?php
namespace Utils;

class Validation
{
    public static function validateCPF(string $cpf): bool
    {
        $cpf = preg_replace('/\D/', '', $cpf);

        if (strlen($cpf) != 11) {
            return false;
        }

        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        $sum = 0;
        for ($i = 0, $j = 10; $i < 9; $i++, $j--) {
            $sum += $cpf[$i] * $j;
        }

        $remainder = $sum % 11;
        $checkDigit1 = $remainder < 2 ? 0 : 11 - $remainder;

        if ($cpf[9] != $checkDigit1) {
            return false;
        }

        $sum = 0;
        for ($i = 0, $j = 11; $i < 10; $i++, $j--) {
            $sum += $cpf[$i] * $j;
        }

        $remainder = $sum % 11;
        $checkDigit2 = $remainder < 2 ? 0 : 11 - $remainder;

        return $cpf[10] == $checkDigit2;
    }

    public static function validateEmail(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    public static function validatePhone(string $phone): bool
    {
        $phone = preg_replace('/\D/', '', $phone);

        $length = strlen($phone);

        if ($length != 10 && $length != 11) {
            return false;
        }

        return true;
    }
}
