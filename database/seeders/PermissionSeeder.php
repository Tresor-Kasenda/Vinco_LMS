<?php

declare(strict_types=1);

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

final class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        $permissions = [
            'user-create',
            'user-list',
            'user-edit',
            'user-delete',
            'user-view',
            'personnel-list',
            'personnel-create',
            'personnel-edit',
            'personnel-delete',
            'personnel-view',
            'professor-list',
            'professor-create',
            'professor-edit',
            'professor-delete',
            'professor-view',
            'campus-list',
            'campus-create',
            'campus-edit',
            'campus-delete',
            'campus-view',
            'department-list',
            'department-create',
            'department-edit',
            'department-delete',
            'department-view',
            'subsidiaries-list',
            'subsidiaries-create',
            'subsidiaries-edit',
            'subsidiaries-delete',
            'subsidiaries-view',
            'promotion-list',
            'promotion-create',
            'promotion-edit',
            'promotion-delete',
            'category-list',
            'category-create',
            'category-edit',
            'category-delete',
            'course-list',
            'course-create',
            'course-edit',
            'course-delete',
            'course-view',
            'chapter-list',
            'chapter-create',
            'chapter-edit',
            'chapter-delete',
            'chapter-view',
            'lesson-list',
            'lesson-create',
            'lesson-edit',
            'lesson-delete',
            'lesson-view',
            'student-list',
            'student-create',
            'student-edit',
            'student-delete',
            'student-view',
            'resource-list',
            'resource-create',
            'resource-edit',
            'resource-delete',
            'resource-view',
            'exam-list',
            'exam-create',
            'exam-edit',
            'exam-delete',
            'exam-view',
            'question-list',
            'question-create',
            'question-edit',
            'question-delete',
            'question-view',
            'exercice-list',
            'exercice-create',
            'exercice-edit',
            'exercice-delete',
            'exercice-view',
            'academic-year-list',
            'academic-year-create',
            'academic-year-edit',
            'academic-year-delete',
            'parent-list',
            'parent-create',
            'parent-edit',
            'parent-delete',
            'parent-view',
            'expense-list',
            'expense-create',
            'expense-edit',
            'expense-delete',
            'result-list',
            'result-create',
            'result-edit',
            'result-delete',
            'result-view',
            'homework-list',
            'homework-create',
            'homework-edit',
            'homework-delete',
            'homework-view',
            'expense-type-list',
            'expense-type-create',
            'expense-type-edit',
            'expense-type-delete',
            'fee-type-list',
            'fee-type-create',
            'fee-type-edit',
            'fee-type-delete',
            'fee-list',
            'fee-create',
            'fee-edit',
            'fee-delete',
            'setting-create',
            'setting-edit',
            'setting-delete',
            'setting-view',
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'calendar-list',
            'calendar-create',
            'calendar-edit',
            'calendar-delete',
            'calendar-view',
            'schedule-list',
            'schedule-create',
            'schedule-edit',
            'schedule-delete',
            'schedule-view',
            'exam-schedule-list',
            'exam-schedule-create',
            'exam-schedule-edit',
            'exam-schedule-delete',
            'event-list',
            'event-view',
            'event-create',
            'event-edit',
            'event-delete',
            'notification-list',
            'notification-view',
            'notification-create',
            'notification-edit',
            'notification-delete',
            'bulletin-list',
            'bulletin-view',
            'bulletin-create',
            'bulletin-edit',
            'bulletin-delete',
            'aperi-list',
            'aperi-view',
            'aperi-create',
            'aperi-edit',
            'aperi-delete',
            'chat-list',
            'chat-view',
            'chat-edit',
            'chat-delete',
            'chat-create',
            'group-list',
            'group-view',
            'group-create',
            'group-edit',
            'group-delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission,
            ]);
        }
    }
}
