<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\AcademicYear.
 *
 * @property int $id
 * @property string $key
 * @property string $startDate
 * @property string $endDate
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|AcademicYear[] $personnel
 * @property-read int|null $personnel_count
 * @method static Builder|AcademicYear newModelQuery()
 * @method static Builder|AcademicYear newQuery()
 * @method static Builder|AcademicYear query()
 * @method static Builder|AcademicYear whereCreatedAt($value)
 * @method static Builder|AcademicYear whereEndDate($value)
 * @method static Builder|AcademicYear whereId($value)
 * @method static Builder|AcademicYear whereKey($value)
 * @method static Builder|AcademicYear whereStartDate($value)
 * @method static Builder|AcademicYear whereUpdatedAt($value)
 * @mixin Eloquent
 * @property-read Collection|Category[] $categories
 * @property-read int|null $categories_count
 * @property string $start_date
 * @property string $end_date
 */
	class AcademicYear extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Campus.
 *
 * @property int $id
 * @property string $key
 * @property int $user_id
 * @property string $name
 * @property string|null $description
 * @property string $images
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Collection|Department[] $departments
 * @property-read int|null $departments_count
 * @property-read User $user
 * @method static Builder|Campus newModelQuery()
 * @method static Builder|Campus newQuery()
 * @method static \Illuminate\Database\Query\Builder|Campus onlyTrashed()
 * @method static Builder|Campus query()
 * @method static Builder|Campus whereCreatedAt($value)
 * @method static Builder|Campus whereDeletedAt($value)
 * @method static Builder|Campus whereDescription($value)
 * @method static Builder|Campus whereId($value)
 * @method static Builder|Campus whereImages($value)
 * @method static Builder|Campus whereKey($value)
 * @method static Builder|Campus whereName($value)
 * @method static Builder|Campus whereStatus($value)
 * @method static Builder|Campus whereUpdatedAt($value)
 * @method static Builder|Campus whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Campus withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Campus withoutTrashed()
 * @mixin \Eloquent
 */
	class Campus extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Category.
 *
 * @property int $id
 * @property string $key
 * @property string $name
 * @property string $description
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property int $academic_year_id
 * @property-read Collection|Course[] $courses
 * @property-read int|null $courses_count
 * @method static Builder|Category newModelQuery()
 * @method static Builder|Category newQuery()
 * @method static \Illuminate\Database\Query\Builder|Category onlyTrashed()
 * @method static Builder|Category query()
 * @method static Builder|Category whereAcademicYearId($value)
 * @method static Builder|Category whereCreatedAt($value)
 * @method static Builder|Category whereDeletedAt($value)
 * @method static Builder|Category whereDescription($value)
 * @method static Builder|Category whereId($value)
 * @method static Builder|Category whereKey($value)
 * @method static Builder|Category whereName($value)
 * @method static Builder|Category whereStatus($value)
 * @method static Builder|Category whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Category withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Category withoutTrashed()
 * @mixin Eloquent
 * @property-read AcademicYear $academic
 */
	class Category extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ChFavorite.
 *
 * @property int $id
 * @property int $user_id
 * @property int $favorite_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ChFavorite newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChFavorite newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChFavorite query()
 * @method static \Illuminate\Database\Eloquent\Builder|ChFavorite whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChFavorite whereFavoriteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChFavorite whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChFavorite whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChFavorite whereUserId($value)
 * @mixin \Eloquent
 */
	class ChFavorite extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ChMessage.
 *
 * @property int $id
 * @property string $type
 * @property int $from_id
 * @property int $to_id
 * @property string|null $body
 * @property string|null $attachment
 * @property int $seen
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ChMessage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChMessage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChMessage query()
 * @method static \Illuminate\Database\Eloquent\Builder|ChMessage whereAttachment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChMessage whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChMessage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChMessage whereFromId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChMessage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChMessage whereSeen($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChMessage whereToId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChMessage whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChMessage whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class ChMessage extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Chapter.
 *
 * @property int $id
 * @property string $key
 * @property int $course_id
 * @property string $name
 * @property string|null $description
 * @property string $displayType
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Course $course
 * @property-read Collection|Exercice[] $exercises
 * @property-read int|null $exercises_count
 * @property-read Collection|Lesson[] $lessons
 * @property-read int|null $lessons_count
 * @property-read Collection|Question[] $questions
 * @property-read int|null $questions_count
 * @method static Builder|Chapter newModelQuery()
 * @method static Builder|Chapter newQuery()
 * @method static \Illuminate\Database\Query\Builder|Chapter onlyTrashed()
 * @method static Builder|Chapter query()
 * @method static Builder|Chapter whereCourseId($value)
 * @method static Builder|Chapter whereCreatedAt($value)
 * @method static Builder|Chapter whereDeletedAt($value)
 * @method static Builder|Chapter whereDescription($value)
 * @method static Builder|Chapter whereDisplayType($value)
 * @method static Builder|Chapter whereId($value)
 * @method static Builder|Chapter whereKey($value)
 * @method static Builder|Chapter whereName($value)
 * @method static Builder|Chapter whereStatus($value)
 * @method static Builder|Chapter whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Chapter withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Chapter withoutTrashed()
 * @mixin \Eloquent
 */
	class Chapter extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Course.
 *
 * @property int $id
 * @property string $key
 * @property int $category_id
 * @property int $user_id
 * @property string $name
 * @property string $subDescription
 * @property string|null $description
 * @property string $duration
 * @property string $images
 * @property string $startDate
 * @property string $endDate
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property int $academic_year_id
 * @property-read Category $category
 * @property-read Collection|Chapter[] $chapters
 * @property-read int|null $chapters_count
 * @property-read Collection|Exam[] $exam
 * @property-read int|null $exam_count
 * @property-read Collection|Exercice[] $exercises
 * @property-read int|null $exercises_count
 * @property-read Collection|Question[] $questions
 * @property-read int|null $questions_count
 * @method static Builder|Course newModelQuery()
 * @method static Builder|Course newQuery()
 * @method static \Illuminate\Database\Query\Builder|Course onlyTrashed()
 * @method static Builder|Course query()
 * @method static Builder|Course whereAcademicYearId($value)
 * @method static Builder|Course whereCategoryId($value)
 * @method static Builder|Course whereCreatedAt($value)
 * @method static Builder|Course whereDeletedAt($value)
 * @method static Builder|Course whereDescription($value)
 * @method static Builder|Course whereDuration($value)
 * @method static Builder|Course whereEndDate($value)
 * @method static Builder|Course whereId($value)
 * @method static Builder|Course whereImages($value)
 * @method static Builder|Course whereKey($value)
 * @method static Builder|Course whereName($value)
 * @method static Builder|Course whereStartDate($value)
 * @method static Builder|Course whereStatus($value)
 * @method static Builder|Course whereSubDescription($value)
 * @method static Builder|Course whereUpdatedAt($value)
 * @method static Builder|Course whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Course withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Course withoutTrashed()
 * @mixin \Eloquent
 * @property-read User|null $user
 * @property string|null $start_date
 * @property string|null $end_date
 */
	class Course extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Department.
 *
 * @property int $id
 * @property string $key
 * @property int $campus_id
 * @property string $name
 * @property string|null $description
 * @property string $images
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Campus $campus
 * @property-read Collection|Professor[] $teacher
 * @property-read int|null $professors_count
 * @property-read Collection|Student[] $students
 * @property-read int|null $students_count
 * @property-read Collection|Subsidiary[] $subdsidiaries
 * @property-read int|null $subdsidiaries_count
 * @property-read Collection|User[] $admin
 * @property-read int|null $users_count
 * @method static Builder|Department newModelQuery()
 * @method static Builder|Department newQuery()
 * @method static \Illuminate\Database\Query\Builder|Department onlyTrashed()
 * @method static Builder|Department query()
 * @method static Builder|Department whereCampusId($value)
 * @method static Builder|Department whereCreatedAt($value)
 * @method static Builder|Department whereDeletedAt($value)
 * @method static Builder|Department whereDescription($value)
 * @method static Builder|Department whereId($value)
 * @method static Builder|Department whereImages($value)
 * @method static Builder|Department whereKey($value)
 * @method static Builder|Department whereName($value)
 * @method static Builder|Department whereStatus($value)
 * @method static Builder|Department whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Department withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Department withoutTrashed()
 * @mixin \Eloquent
 * @property-read Collection|Professor[] $teachers
 * @property-read int|null $teachers_count
 * @property-read Collection|User[] $users
 */
	class Department extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Event
 *
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Event newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Event newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Event query()
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $title
 * @property \Illuminate\Support\Carbon $start_date
 * @property \Illuminate\Support\Carbon $end_date
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Event whereTitle($value)
 */
	class Event extends \Eloquent implements \MaddHatter\LaravelFullcalendar\Event {}
}

namespace App\Models{
/**
 * App\Models\Exam.
 *
 * @property int $id
 * @property string $key
 * @property int $course_id
 * @property string $name
 * @property string $condition
 * @property int $weighting
 * @property string $date
 * @property string $schedule
 * @property string $duration
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Course $course
 * @method static Builder|Exam newModelQuery()
 * @method static Builder|Exam newQuery()
 * @method static \Illuminate\Database\Query\Builder|Exam onlyTrashed()
 * @method static Builder|Exam query()
 * @method static Builder|Exam whereCondition($value)
 * @method static Builder|Exam whereCourseId($value)
 * @method static Builder|Exam whereCreatedAt($value)
 * @method static Builder|Exam whereDate($value)
 * @method static Builder|Exam whereDeletedAt($value)
 * @method static Builder|Exam whereDuration($value)
 * @method static Builder|Exam whereId($value)
 * @method static Builder|Exam whereKey($value)
 * @method static Builder|Exam whereName($value)
 * @method static Builder|Exam whereSchedule($value)
 * @method static Builder|Exam whereStatus($value)
 * @method static Builder|Exam whereUpdatedAt($value)
 * @method static Builder|Exam whereWeighting($value)
 * @method static \Illuminate\Database\Query\Builder|Exam withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Exam withoutTrashed()
 * @mixin \Eloquent
 */
	class Exam extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Exercice.
 *
 * @property int $id
 * @property string $key
 * @property int $course_id
 * @property int|null $chapter_id
 * @property int|null $lesson_id
 * @property string $name
 * @property string $condition
 * @property int $weighting
 * @property string $date
 * @property string $schedule
 * @property string $duration
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Chapter|null $chapter
 * @property-read Course $course
 * @property-read Lesson|null $lesson
 * @method static Builder|Exercice newModelQuery()
 * @method static Builder|Exercice newQuery()
 * @method static \Illuminate\Database\Query\Builder|Exercice onlyTrashed()
 * @method static Builder|Exercice query()
 * @method static Builder|Exercice whereChapterId($value)
 * @method static Builder|Exercice whereCondition($value)
 * @method static Builder|Exercice whereCourseId($value)
 * @method static Builder|Exercice whereCreatedAt($value)
 * @method static Builder|Exercice whereDate($value)
 * @method static Builder|Exercice whereDeletedAt($value)
 * @method static Builder|Exercice whereDuration($value)
 * @method static Builder|Exercice whereId($value)
 * @method static Builder|Exercice whereKey($value)
 * @method static Builder|Exercice whereLessonId($value)
 * @method static Builder|Exercice whereName($value)
 * @method static Builder|Exercice whereSchedule($value)
 * @method static Builder|Exercice whereStatus($value)
 * @method static Builder|Exercice whereUpdatedAt($value)
 * @method static Builder|Exercice whereWeighting($value)
 * @method static \Illuminate\Database\Query\Builder|Exercice withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Exercice withoutTrashed()
 * @mixin \Eloquent
 */
	class Exercice extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Expense.
 *
 * @property int $id
 * @property string $key
 * @property string $amount
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $expense_type_id
 * @method static Builder|Expense newModelQuery()
 * @method static Builder|Expense newQuery()
 * @method static Builder|Expense query()
 * @method static Builder|Expense whereAmount($value)
 * @method static Builder|Expense whereCreatedAt($value)
 * @method static Builder|Expense whereDescription($value)
 * @method static Builder|Expense whereExpenseTypeId($value)
 * @method static Builder|Expense whereId($value)
 * @method static Builder|Expense whereKey($value)
 * @method static Builder|Expense whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read ExpenseType $types
 */
	class Expense extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ExpenseType.
 *
 * @property int $id
 * @property string $key
 * @property string $name
 * @property string $image
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|ExpenseType newModelQuery()
 * @method static Builder|ExpenseType newQuery()
 * @method static Builder|ExpenseType query()
 * @method static Builder|ExpenseType whereCreatedAt($value)
 * @method static Builder|ExpenseType whereId($value)
 * @method static Builder|ExpenseType whereImage($value)
 * @method static Builder|ExpenseType whereKey($value)
 * @method static Builder|ExpenseType whereName($value)
 * @method static Builder|ExpenseType whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property-read Collection|Expense[] $expense
 * @property-read int|null $expense_count
 */
	class ExpenseType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Fee.
 *
 * @property int $id
 * @property int $fee_type_id
 * @property int $student_id
 * @property string $transaction_no
 * @property string $amount
 * @property string $due_date
 * @property string $pay_date
 * @property string $status
 * @property string $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read FeeType $feeType
 * @property-read Student $student
 * @method static Builder|Fee newModelQuery()
 * @method static Builder|Fee newQuery()
 * @method static Builder|Fee query()
 * @method static Builder|Fee whereAmount($value)
 * @method static Builder|Fee whereCreatedAt($value)
 * @method static Builder|Fee whereDescription($value)
 * @method static Builder|Fee whereDueDate($value)
 * @method static Builder|Fee whereFeeTypeId($value)
 * @method static Builder|Fee whereId($value)
 * @method static Builder|Fee wherePayDate($value)
 * @method static Builder|Fee whereStatus($value)
 * @method static Builder|Fee whereStudentId($value)
 * @method static Builder|Fee whereTransactionNo($value)
 * @method static Builder|Fee whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $guardian_id
 * @method static Builder|Fee whereGuardianId($value)
 */
	class Fee extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\FeeType.
 *
 * @property int $id
 * @property string $name
 * @property string $images
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|Fee[] $feeType
 * @property-read int|null $fee_type_count
 * @method static Builder|FeeType newModelQuery()
 * @method static Builder|FeeType newQuery()
 * @method static Builder|FeeType query()
 * @method static Builder|FeeType whereCreatedAt($value)
 * @method static Builder|FeeType whereId($value)
 * @method static Builder|FeeType whereImages($value)
 * @method static Builder|FeeType whereName($value)
 * @method static Builder|FeeType whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class FeeType extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Guardian.
 *
 * @property int $id
 * @property string $key
 * @property int $user_id
 * @property string $gender
 * @property string $image
 * @property string $phones
 * @property string|null $occupation
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Guardian newModelQuery()
 * @method static Builder|Guardian newQuery()
 * @method static Builder|Guardian query()
 * @method static Builder|Guardian whereCreatedAt($value)
 * @method static Builder|Guardian whereGender($value)
 * @method static Builder|Guardian whereId($value)
 * @method static Builder|Guardian whereImage($value)
 * @method static Builder|Guardian whereKey($value)
 * @method static Builder|Guardian whereOccupation($value)
 * @method static Builder|Guardian wherePhones($value)
 * @method static Builder|Guardian whereUpdatedAt($value)
 * @method static Builder|Guardian whereUserId($value)
 * @mixin Eloquent
 * @property string $name_guardian
 * @property string|null $firstName_guardian
 * @property string $email_guardian
 * @property string $images
 * @method static Builder|Guardian whereEmailGuardian($value)
 * @method static Builder|Guardian whereFirstNameGuardian($value)
 * @method static Builder|Guardian whereImages($value)
 * @method static Builder|Guardian whereNameGuardian($value)
 * @property-read \App\Models\User $user
 */
	class Guardian extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Homework.
 *
 * @property int $id
 * @property string $key
 * @property int|null $course_id
 * @property int|null $chapter_id
 * @property int|null $lesson_id
 * @property string $name
 * @property int|null $weighting
 * @property string $schedule
 * @property string|null $duration
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static Builder|Homework newModelQuery()
 * @method static Builder|Homework newQuery()
 * @method static Builder|Homework query()
 * @method static Builder|Homework whereChapterId($value)
 * @method static Builder|Homework whereCourseId($value)
 * @method static Builder|Homework whereCreatedAt($value)
 * @method static Builder|Homework whereDeletedAt($value)
 * @method static Builder|Homework whereDuration($value)
 * @method static Builder|Homework whereId($value)
 * @method static Builder|Homework whereKey($value)
 * @method static Builder|Homework whereLessonId($value)
 * @method static Builder|Homework whereName($value)
 * @method static Builder|Homework whereSchedule($value)
 * @method static Builder|Homework whereStatus($value)
 * @method static Builder|Homework whereUpdatedAt($value)
 * @method static Builder|Homework whereWeighting($value)
 * @mixin \Eloquent
 */
	class Homework extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Lesson.
 *
 * @property int $id
 * @property string $key
 * @property int $chapter_id
 * @property string $name
 * @property string $shortContent
 * @property string|null $content
 * @property int|null $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read Chapter $chapter
 * @property-read Collection|Exercice[] $exercises
 * @property-read int|null $exercises_count
 * @property-read Collection|resource[] $resources
 * @property-read int|null $resources_count
 * @method static Builder|Lesson newModelQuery()
 * @method static Builder|Lesson newQuery()
 * @method static \Illuminate\Database\Query\Builder|Lesson onlyTrashed()
 * @method static Builder|Lesson query()
 * @method static Builder|Lesson whereChapterId($value)
 * @method static Builder|Lesson whereContent($value)
 * @method static Builder|Lesson whereCreatedAt($value)
 * @method static Builder|Lesson whereDeletedAt($value)
 * @method static Builder|Lesson whereId($value)
 * @method static Builder|Lesson whereKey($value)
 * @method static Builder|Lesson whereName($value)
 * @method static Builder|Lesson whereShortContent($value)
 * @method static Builder|Lesson whereStatus($value)
 * @method static Builder|Lesson whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Lesson withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Lesson withoutTrashed()
 * @mixin Eloquent
 * @property-read int $difference
 * @property string|null $end_time
 * @property string|null $start_time
 * @method static Builder|Lesson calendarByRoleOrClassId()
 * @property string $content_type
 * @method static Builder|Lesson whereContentType($value)
 */
	class Lesson extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Notification
 *
 * @property int $id
 * @property string $title
 * @property string $content
 * @property string $images
 * @property string $start_date
 * @property string $end_date
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Notification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification query()
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereEndDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereImages($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereStartDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Notification whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Notification extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Personnel.
 *
 * @property int $id
 * @property string $key
 * @property int $user_id
 * @property string $username
 * @property string $matriculate
 * @property string $firstname
 * @property string $lastname
 * @property string $email
 * @property string $phones
 * @property string $nationality
 * @property string $images
 * @property string $location
 * @property string $identityCard
 * @property string $gender
 * @property string $birthdays
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property int $academic_year_id
 * @property-read AcademicYear $academic
 * @property-read User $user
 * @method static Builder|Personnel newModelQuery()
 * @method static Builder|Personnel newQuery()
 * @method static \Illuminate\Database\Query\Builder|Personnel onlyTrashed()
 * @method static Builder|Personnel query()
 * @method static Builder|Personnel whereAcademicYearId($value)
 * @method static Builder|Personnel whereBirthdays($value)
 * @method static Builder|Personnel whereCreatedAt($value)
 * @method static Builder|Personnel whereDeletedAt($value)
 * @method static Builder|Personnel whereEmail($value)
 * @method static Builder|Personnel whereFirstname($value)
 * @method static Builder|Personnel whereGender($value)
 * @method static Builder|Personnel whereId($value)
 * @method static Builder|Personnel whereIdentityCard($value)
 * @method static Builder|Personnel whereImages($value)
 * @method static Builder|Personnel whereKey($value)
 * @method static Builder|Personnel whereLastname($value)
 * @method static Builder|Personnel whereLocation($value)
 * @method static Builder|Personnel whereMatriculate($value)
 * @method static Builder|Personnel whereNationality($value)
 * @method static Builder|Personnel wherePhones($value)
 * @method static Builder|Personnel whereStatus($value)
 * @method static Builder|Personnel whereUpdatedAt($value)
 * @method static Builder|Personnel whereUserId($value)
 * @method static Builder|Personnel whereUsername($value)
 * @method static \Illuminate\Database\Query\Builder|Personnel withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Personnel withoutTrashed()
 * @mixin \Eloquent
 */
	class Personnel extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Professor.
 *
 * @property int $id
 * @property string $key
 * @property int $user_id
 * @property string $username
 * @property string $firstname
 * @property string $lastname
 * @property string $personnelEmail
 * @property string $phoneNumber
 * @property string $matriculate
 * @property string $country
 * @property string $images
 * @property string $location
 * @property string $identityCard
 * @property string $gender
 * @property string $birthdays
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property int $department_id
 * @property int $academic_year_id
 * @property-read Department $department
 * @property-read User $user
 * @method static Builder|Professor newModelQuery()
 * @method static Builder|Professor newQuery()
 * @method static \Illuminate\Database\Query\Builder|Professor onlyTrashed()
 * @method static Builder|Professor query()
 * @method static Builder|Professor whereAcademicYearId($value)
 * @method static Builder|Professor whereBirthdays($value)
 * @method static Builder|Professor whereCountry($value)
 * @method static Builder|Professor whereCreatedAt($value)
 * @method static Builder|Professor whereDeletedAt($value)
 * @method static Builder|Professor whereDepartmentId($value)
 * @method static Builder|Professor whereFirstname($value)
 * @method static Builder|Professor whereGender($value)
 * @method static Builder|Professor whereId($value)
 * @method static Builder|Professor whereIdentityCard($value)
 * @method static Builder|Professor whereImages($value)
 * @method static Builder|Professor whereKey($value)
 * @method static Builder|Professor whereLastname($value)
 * @method static Builder|Professor whereLocation($value)
 * @method static Builder|Professor whereMatriculate($value)
 * @method static Builder|Professor wherePersonnelEmail($value)
 * @method static Builder|Professor wherePhoneNumber($value)
 * @method static Builder|Professor whereStatus($value)
 * @method static Builder|Professor whereUpdatedAt($value)
 * @method static Builder|Professor whereUserId($value)
 * @method static Builder|Professor whereUsername($value)
 * @method static \Illuminate\Database\Query\Builder|Professor withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Professor withoutTrashed()
 * @mixin Eloquent
 * @property string $email
 * @property string $phones
 * @method static Builder|Professor whereEmail($value)
 * @method static Builder|Professor wherePhones($value)
 */
	class Professor extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Profile.
 *
 * @property int $id
 * @property string $key
 * @property int $user_id
 * @property string $images
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User $user
 * @method static Builder|Profile newModelQuery()
 * @method static Builder|Profile newQuery()
 * @method static Builder|Profile query()
 * @method static Builder|Profile whereCreatedAt($value)
 * @method static Builder|Profile whereId($value)
 * @method static Builder|Profile whereImages($value)
 * @method static Builder|Profile whereKey($value)
 * @method static Builder|Profile whereUpdatedAt($value)
 * @method static Builder|Profile whereUserId($value)
 * @mixin \Eloquent
 */
	class Profile extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Promotion.
 *
 * @property int $id
 * @property string $key
 * @property int $subsidiary_id
 * @property string $name
 * @property string|null $description
 * @property string $images
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property int $academic_year_id
 * @property-read Collection|Student[] $students
 * @property-read int|null $students_count
 * @property-read Subsidiary|null $subsidiary
 * @method static Builder|Promotion newModelQuery()
 * @method static Builder|Promotion newQuery()
 * @method static \Illuminate\Database\Query\Builder|Promotion onlyTrashed()
 * @method static Builder|Promotion query()
 * @method static Builder|Promotion whereAcademicYearId($value)
 * @method static Builder|Promotion whereCreatedAt($value)
 * @method static Builder|Promotion whereDeletedAt($value)
 * @method static Builder|Promotion whereDescription($value)
 * @method static Builder|Promotion whereId($value)
 * @method static Builder|Promotion whereImages($value)
 * @method static Builder|Promotion whereKey($value)
 * @method static Builder|Promotion whereName($value)
 * @method static Builder|Promotion whereStatus($value)
 * @method static Builder|Promotion whereSubsidiaryId($value)
 * @method static Builder|Promotion whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Promotion withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Promotion withoutTrashed()
 * @mixin Eloquent
 * @property-read AcademicYear $academic
 */
	class Promotion extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Question.
 *
 * @property int $id
 * @property string $key
 * @property int $course_id
 * @property int|null $chapter_id
 * @property string $name
 * @property string $condition
 * @property int $weighting
 * @property string $date
 * @property string $schedule
 * @property string $duration
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Chapter|null $chapter
 * @property-read Course $course
 * @method static Builder|Question newModelQuery()
 * @method static Builder|Question newQuery()
 * @method static \Illuminate\Database\Query\Builder|Question onlyTrashed()
 * @method static Builder|Question query()
 * @method static Builder|Question whereChapterId($value)
 * @method static Builder|Question whereCondition($value)
 * @method static Builder|Question whereCourseId($value)
 * @method static Builder|Question whereCreatedAt($value)
 * @method static Builder|Question whereDate($value)
 * @method static Builder|Question whereDeletedAt($value)
 * @method static Builder|Question whereDuration($value)
 * @method static Builder|Question whereId($value)
 * @method static Builder|Question whereKey($value)
 * @method static Builder|Question whereName($value)
 * @method static Builder|Question whereSchedule($value)
 * @method static Builder|Question whereStatus($value)
 * @method static Builder|Question whereUpdatedAt($value)
 * @method static Builder|Question whereWeighting($value)
 * @method static \Illuminate\Database\Query\Builder|Question withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Question withoutTrashed()
 * @mixin \Eloquent
 */
	class Question extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Resource.
 *
 * @property int $id
 * @property string $key
 * @property int $lesson_id
 * @property string $name
 * @property string $files
 * @property string $path
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Lesson $lesson
 * @method static Builder|Resource newModelQuery()
 * @method static Builder|Resource newQuery()
 * @method static \Illuminate\Database\Query\Builder|Resource onlyTrashed()
 * @method static Builder|Resource query()
 * @method static Builder|Resource whereCreatedAt($value)
 * @method static Builder|Resource whereDeletedAt($value)
 * @method static Builder|Resource whereFiles($value)
 * @method static Builder|Resource whereId($value)
 * @method static Builder|Resource whereKey($value)
 * @method static Builder|Resource whereLessonId($value)
 * @method static Builder|Resource whereName($value)
 * @method static Builder|Resource wherePath($value)
 * @method static Builder|Resource whereStatus($value)
 * @method static Builder|Resource whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|Resource withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Resource withoutTrashed()
 * @mixin \Eloquent
 */
	class Resource extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Result.
 *
 * @property int $id
 * @property string $key
 * @property int $course_id
 * @property int $student_id
 * @property string $cote
 * @property string $observation
 * @property string $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Result newModelQuery()
 * @method static Builder|Result newQuery()
 * @method static Builder|Result query()
 * @method static Builder|Result whereCote($value)
 * @method static Builder|Result whereCourseId($value)
 * @method static Builder|Result whereCreatedAt($value)
 * @method static Builder|Result whereId($value)
 * @method static Builder|Result whereKey($value)
 * @method static Builder|Result whereObservation($value)
 * @method static Builder|Result whereStatus($value)
 * @method static Builder|Result whereStudentId($value)
 * @method static Builder|Result whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Result extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Setting.
 *
 * @property int $id
 * @property int $user_id
 * @property string $app_name
 * @property string|null $short_name
 * @property string|null $app_email
 * @property string|null $app_phone
 * @property string|null $app_address
 * @property string|null $app_icons
 * @property string|null $app_images
 * @property string|null $class_start
 * @property string|null $class_end
 * @property string|null $routine_time_difference
 * @property string|null $app_time_zone
 * @property Carbon|null $deleted_at
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read User $user
 * @method static Builder|Setting newModelQuery()
 * @method static Builder|Setting newQuery()
 * @method static \Illuminate\Database\Query\Builder|Setting onlyTrashed()
 * @method static Builder|Setting query()
 * @method static Builder|Setting whereAppAddress($value)
 * @method static Builder|Setting whereAppEmail($value)
 * @method static Builder|Setting whereAppIcons($value)
 * @method static Builder|Setting whereAppImages($value)
 * @method static Builder|Setting whereAppName($value)
 * @method static Builder|Setting whereAppPhone($value)
 * @method static Builder|Setting whereAppTimeZone($value)
 * @method static Builder|Setting whereClassEnd($value)
 * @method static Builder|Setting whereClassStart($value)
 * @method static Builder|Setting whereCreatedAt($value)
 * @method static Builder|Setting whereDeletedAt($value)
 * @method static Builder|Setting whereId($value)
 * @method static Builder|Setting whereRoutineTimeDifference($value)
 * @method static Builder|Setting whereShortName($value)
 * @method static Builder|Setting whereUpdatedAt($value)
 * @method static Builder|Setting whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Setting withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Setting withoutTrashed()
 * @mixin \Eloquent
 */
	class Setting extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Student.
 *
 * @property int $id
 * @property string $key
 * @property int $user_id
 * @property int|null $promotion_id
 * @property int|null $department_id
 * @property int|null $subsidiary_id
 * @property string $firstname
 * @property string $middlename
 * @property string $lastname
 * @property string $email
 * @property string $phoneNumber
 * @property string $matriculate
 * @property string $images
 * @property string $nationality
 * @property string $location
 * @property string $identityCard
 * @property string $birthdays
 * @property string $bornCity
 * @property string $bornTown
 * @property string $responsibleName
 * @property string $responsiblePhone
 * @property string $gender
 * @property string $address
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property int $academic_year_id
 * @property-read Department|null $department
 * @property-read Promotion|null $promotion
 * @property-read Subsidiary|null $subsidiary
 * @property-read User|null $user
 * @method static Builder|Student newModelQuery()
 * @method static Builder|Student newQuery()
 * @method static \Illuminate\Database\Query\Builder|Student onlyTrashed()
 * @method static Builder|Student query()
 * @method static Builder|Student whereAcademicYearId($value)
 * @method static Builder|Student whereAddress($value)
 * @method static Builder|Student whereBirthdays($value)
 * @method static Builder|Student whereBornCity($value)
 * @method static Builder|Student whereBornTown($value)
 * @method static Builder|Student whereCreatedAt($value)
 * @method static Builder|Student whereDeletedAt($value)
 * @method static Builder|Student whereDepartmentId($value)
 * @method static Builder|Student whereEmail($value)
 * @method static Builder|Student whereFirstname($value)
 * @method static Builder|Student whereGender($value)
 * @method static Builder|Student whereId($value)
 * @method static Builder|Student whereIdentityCard($value)
 * @method static Builder|Student whereImages($value)
 * @method static Builder|Student whereKey($value)
 * @method static Builder|Student whereLastname($value)
 * @method static Builder|Student whereLocation($value)
 * @method static Builder|Student whereMatriculate($value)
 * @method static Builder|Student whereMiddlename($value)
 * @method static Builder|Student whereNationality($value)
 * @method static Builder|Student wherePhoneNumber($value)
 * @method static Builder|Student wherePromotionId($value)
 * @method static Builder|Student whereResponsibleName($value)
 * @method static Builder|Student whereResponsiblePhone($value)
 * @method static Builder|Student whereStatus($value)
 * @method static Builder|Student whereSubsidiaryId($value)
 * @method static Builder|Student whereUpdatedAt($value)
 * @method static Builder|Student whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Student withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Student withoutTrashed()
 * @mixin \Eloquent
 * @property-read Collection|Fee[] $fees
 * @property-read int|null $fees_count
 * @property string|null $phone_number
 * @property string|null $identity_card
 * @property string|null $born_city
 * @property string|null $parent_name
 * @property string|null $parent_phone
 * @property int $guardian_id
 * @property string|null $admission
 * @method static Builder|Student whereAdmission($value)
 * @method static Builder|Student whereGuardianId($value)
 * @method static Builder|Student whereParentName($value)
 * @method static Builder|Student whereParentPhone($value)
 */
	class Student extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Subsidiary.
 *
 * @property int $id
 * @property string $key
 * @property int $department_id
 * @property int $user_id
 * @property string $name
 * @property string|null $description
 * @property string $images
 * @property int $status
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property int $academic_year_id
 * @property-read Department $department
 * @property-read Collection|Promotion[] $promotions
 * @property-read int|null $promotions_count
 * @property-read Collection|Student[] $students
 * @property-read int|null $students_count
 * @property-read User $user
 * @method static Builder|Subsidiary newModelQuery()
 * @method static Builder|Subsidiary newQuery()
 * @method static \Illuminate\Database\Query\Builder|Subsidiary onlyTrashed()
 * @method static Builder|Subsidiary query()
 * @method static Builder|Subsidiary whereAcademicYearId($value)
 * @method static Builder|Subsidiary whereCreatedAt($value)
 * @method static Builder|Subsidiary whereDeletedAt($value)
 * @method static Builder|Subsidiary whereDepartmentId($value)
 * @method static Builder|Subsidiary whereDescription($value)
 * @method static Builder|Subsidiary whereId($value)
 * @method static Builder|Subsidiary whereImages($value)
 * @method static Builder|Subsidiary whereKey($value)
 * @method static Builder|Subsidiary whereName($value)
 * @method static Builder|Subsidiary whereStatus($value)
 * @method static Builder|Subsidiary whereUpdatedAt($value)
 * @method static Builder|Subsidiary whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|Subsidiary withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Subsidiary withoutTrashed()
 * @mixin Eloquent
 * @property-read AcademicYear $academic
 */
	class Subsidiary extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User.
 *
 * @property int $id
 * @property string $key
 * @property string $name
 * @property string|null $firstName
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property int $role_id
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $deleted_at
 * @property-read Campus|null $campus
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read Personnel|null $personnel
 * @property-read Collection|Professor[] $teacher
 * @property-read int|null $professors_count
 * @property-read Collection|Student[] $students
 * @property-read int|null $students_count
 * @property-read Subsidiary|null $subsidiary
 * @property-read Collection|PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @property-read Collection|Department[] $admin
 * @property-read int|null $users_count
 * @method static UserFactory factory(...$parameters)
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static \Illuminate\Database\Query\Builder|User onlyTrashed()
 * @method static Builder|User query()
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereDeletedAt($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereEmailVerifiedAt($value)
 * @method static Builder|User whereFirstName($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereKey($value)
 * @method static Builder|User whereName($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereRoleId($value)
 * @method static Builder|User whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|User withoutTrashed()
 * @mixin Eloquent
 * @property int $status
 * @method static Builder|User whereStatus($value)
 * @property-read bool $is_admin
 * @property-read bool $is_student
 * @property-read bool $is_teacher
 * @property-read int|null $roles_count
 * @property-read Profile|null $profile
 * @property-read Collection|Professor[] $professors
 * @property-read Collection|Department[] $users
 * @property int $active_status
 * @property string $avatar
 * @property int $dark_mode
 * @property string $messenger_color
 * @property-read Setting|null $setting
 * @method static Builder|User whereActiveStatus($value)
 * @method static Builder|User whereAvatar($value)
 * @method static Builder|User whereDarkMode($value)
 * @method static Builder|User whereMessengerColor($value)
 * @property-read Collection|Permission[] $permissions
 * @property-read int|null $permissions_count
 * @method static Builder|User permission($permissions)
 * @method static Builder|User role($roles, $guard = null)
 * @property-read Collection|\Spatie\Permission\Models\Role[] $roles
 */
	class User extends \Eloquent {}
}

