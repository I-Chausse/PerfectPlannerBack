<?php
namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use App\Models\DomainItem;

class DomainItemInSpecificDomain implements ValidationRule
{
    protected $domainCode;

    /**
     * Create a new rule instance.
     *
     * @param string $domainCode
     */
    public function __construct(string $domainCode)
    {
        $this->domainCode = $domainCode;
    }

    /**
     * Run the validation rule.
     *
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $exists = DomainItem::where('id', $value)
            ->whereHas('domain', function ($query) {
                $query->where('code', $this->domainCode);
            })
            ->exists();

        if (!$exists) {
            $fail("The selected domain item is invalid or does not belong to the specified domain.");
        }
    }
}

?>
