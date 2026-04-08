<?php

class Worker {
    private string $name;
    private int $age;
    private float $salary;

    // Конструктор
    public function __construct(string $name, int $age, float $salary) {
        $this->name = $name;
        $this->age = $age;
        $this->salary = $salary;
    }

    // Пункт 3: getName
    public function getName(): string {
        return $this->name;
    }

    // Пункт 4: getAge (изначально)
    // Пункт 7: свойство age сделано private, метод переименован в setAge
    // Пункт 8: проверка возраста
    public function setAge(int $newAge): void {
        if ($this->checkAge($newAge)) {
            $this->age = $newAge;
            echo "Возраст изменён на $newAge<br>";
        } else {
            echo "Вам работать в нашей компании еще рано<br>";
        }
    }

    // Пункт 9: checkAge (позже сделаем приватным)
    // Пункт 10: checkAge стал приватным
    private function checkAge(int $ageToCheck): bool {
        return $ageToCheck >= 18;
    }

    // Пункт 5: getSalary
    public function getSalary(): float {
        return $this->salary;
    }

    // Дополнительно: чтобы посмотреть возраст (не требуется по заданию, но полезно)
    public function getAge(): int {
        return $this->age;
    }
}

// Пункт 1: создаём 2 объекта
$worker1 = new Worker("Иван Петров", 25, 50000);
$worker2 = new Worker("Мария Сидорова", 30, 60000);

// Пункт 2: сумма зарплат и сумма возрастов
$totalSalary = $worker1->getSalary() + $worker2->getSalary();
$totalAge = $worker1->getAge() + $worker2->getAge();

echo "=== Пункт 2 ===<br>";
echo "Сумма зарплат: $totalSalary<br>";
echo "Сумма возрастов: $totalAge<br><br>";

// Пункт 5: вывести работу метода getSalary
echo "=== Пункт 5 ===<br>";
echo "Зарплата {$worker1->getName()}: {$worker1->getSalary()}<br>";
echo "Зарплата {$worker2->getName()}: {$worker2->getSalary()}<br><br>";

// Пункт 6: найти сумму зарплат через метод getSalary
echo "=== Пункт 6 ===<br>";
echo "Сумма зарплат (через getSalary): " . ($worker1->getSalary() + $worker2->getSalary()) . "<br><br>";

// Пункт 7 и 8: используем setAge
echo "=== Пункты 7–8 ===<br>";
$worker1->setAge(17); // Должен выдать предупреждение
$worker1->setAge(35);

// Пункт 9: checkAge (до того как сделали приватным)
// Но так как checkAge теперь приватный, проверим его работу через setAge
echo "<br>=== Пункт 9 ===<br>";
$worker3 = new Worker("Тестовый", 20, 1000);
$worker3->setAge(16); // не пройдёт
$worker3->setAge(25); // пройдёт

// Пункт 10: уже реализован — checkAge приватный, setAge публичный и использует checkAge
echo "<br>=== Пункт 10 ===<br>";
echo "checkAge теперь приватный, setAge — публичный.<br>";
echo "Попытка установить возраст 17: ";
$worker1->setAge(17); // выведет "Вам работать..."
echo "Попытка установить возраст 40: ";
$worker1->setAge(40);
