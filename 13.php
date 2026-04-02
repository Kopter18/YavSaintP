<?php

// 1. Создайте класс Работник
class Worker {
    // Свойства (делаем age и salary скрытыми, как требуется позже)
    public string $name;
    private int $age;
    private float $salary;

    // Конструктор для удобства создания объектов (не обязательно по заданию, но полезно)
    public function __construct(string $name, int $age, float $salary) {
        $this->name = $name;
        $this->setAge($age); // используем setAge для проверки
        $this->salary = $salary;
    }

    // 3. Метод getName
    public function getName(): string {
        return $this->name;
    }

    // 4. Метод getAge (пока просто возвращает возраст)
    public function getAge(): int {
        return $this->age;
    }

    // 5. Метод getSalary (возвращает зарплату одного работника)
    public function getSalary(): float {
        return $this->salary;
    }

    // 7. Метод setAge (заменяет getAge, делает возраст скрытым)
    // 8. Добавляем проверку возраста
    public function setAge(int $newAge): void {
        if ($newAge >= 18) {
            $this->age = $newAge;
        } else {
            echo "Вам работать в нашей компании еще рано<br>\n";
        }
    }

    // 9. Метод checkAge (проверяет, что работнику больше 18 лет)
    // 10. Позже сделаем его приватным, а setAge будет его использовать
    private function checkAge(int $ageToCheck): bool {
        return $ageToCheck >= 18;
    }

    // 10. Изменённый setAge, который использует приватный checkAge
    public function setAgeWithCheck(int $newAge): void {
        if ($this->checkAge($newAge)) {
            $this->age = $newAge;
        } else {
            echo "Вам работать в нашей компании еще рано<br>\n";
        }
    }

    // Дополнительный метод для получения описания (не требуется, но удобно для вывода)
    public function getInfo(): string {
        return "Имя: {$this->name}, Возраст: {$this->age}, Зарплата: {$this->salary}";
    }
}

// Создаём 2 объекта класса Worker
$worker1 = new Worker("Иван Петров", 25, 50000);
$worker2 = new Worker("Анна Сидорова", 17, 45000); // возраст 17 - должно выдать предупреждение

// 2. Выводим сумму зарплат и сумму возрастов
$totalSalary = $worker1->getSalary() + $worker2->getSalary();
$totalAge = $worker1->getAge() + $worker2->getAge();

echo "=== Пункт 2 ===<br>\n";
echo "Сумма зарплат: $totalSalary руб.<br>\n";
echo "Сумма возрастов: $totalAge лет<br>\n";

// 5. Выводим работу метода getSalary для каждого
echo "<br>=== Пункт 5 ===<br>\n";
echo "Зарплата {$worker1->getName()}: {$worker1->getSalary()} руб.<br>\n";
echo "Зарплата {$worker2->getName()}: {$worker2->getSalary()} руб.<br>\n";

// 6. Изменяем подход: статический метод или отдельная функция для суммы зарплат.
//    По заданию нужно, чтобы с помощью getSalary находить сумму зарплат созданных работников.
//    Сделаем это через простую функцию вне класса.
function getTotalSalary(Worker ...$workers): float {
    $sum = 0;
    foreach ($workers as $worker) {
        $sum += $worker->getSalary();
    }
    return $sum;
}

echo "<br>=== Пункт 6 ===<br>\n";
echo "Сумма зарплат (через getSalary и функцию): " . getTotalSalary($worker1, $worker2) . " руб.<br>\n";

// 7-8. Уже реализовано в setAge. Покажем работу setAge
echo "<br>=== Пункты 7-8 ===<br>\n";
$worker3 = new Worker("Тест Тестов", 20, 60000);
echo "До setAge: " . $worker3->getAge() . "<br>\n";
$worker3->setAge(15); // должно вывести "Вам работать рано"
$worker3->setAge(30);
echo "После setAge(30): " . $worker3->getAge() . "<br>\n";

// 9. Метод checkAge (сделаем отдельный публичный метод, который просто проверяет возраст объекта)
//    Но по заданию checkAge должен проверять, что работнику больше 18 лет и возвращать true/false.
//    Добавим публичный метод isAdult().
class WorkerFinal {
    public string $name;
    private int $age;
    private float $salary;

    public function __construct(string $name, int $age, float $salary) {
        $this->name = $name;
        $this->setAge($age);
        $this->salary = $salary;
    }

    public function getName(): string { return $this->name; }
    public function getAge(): int { return $this->age; }
    public function getSalary(): float { return $this->salary; }

    public function setAge(int $newAge): void {
        if ($newAge >= 18) {
            $this->age = $newAge;
        } else {
            echo "Вам работать в нашей компании еще рано<br>\n";
        }
    }

    // Публичный метод checkAge (по заданию пункт 9)
    public function checkAge(): bool {
        return $this->age >= 18;
    }

    // Приватный метод checkAgePrivate для пункта 10
    private function checkAgePrivate(int $ageToCheck): bool {
        return $ageToCheck >= 18;
    }

    // Публичный setAgeWithPrivateCheck для пункта 10
    public function setAgeWithPrivateCheck(int $newAge): void {
        if ($this->checkAgePrivate($newAge)) {
            $this->age = $newAge;
        } else {
            echo "Вам работать в нашей компании еще рано<br>\n";
        }
    }
}

// Демонстрация пункта 9
echo "<br>=== Пункт 9 ===<br>\n";
$workerA = new WorkerFinal("Мария Лебедева", 22, 55000);
$workerB = new WorkerFinal("Олег Малый", 16, 40000); // возраст 16 - при создании выведет предупреждение

echo "{$workerA->getName()} старше 18? " . ($workerA->checkAge() ? "Да" : "Нет") . "<br>\n";
echo "{$workerB->getName()} старше 18? " . ($workerB->checkAge() ? "Да" : "Нет") . "<br>\n";

// Демонстрация пункта 10
echo "<br>=== Пункт 10 ===<br>\n";
$workerC = new WorkerFinal("Дмитрий Круглов", 25, 70000);
echo "Возраст до изменения: " . $workerC->getAge() . "<br>\n";
$workerC->setAgeWithPrivateCheck(17); // должно сказать "рано"
$workerC->setAgeWithPrivateCheck(30);
echo "Возраст после setAgeWithPrivateCheck(30): " . $workerC->getAge() . "<br>\n";

?>
