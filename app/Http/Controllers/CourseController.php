<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Http\Response;
use App\Models\Course;
use App\Models\Category;
use App\Models\User;
class CourseController extends Controller
{

  // [get] /instructor/course 
  public function index(Request $request, Response $response)
  {
     $courses = Course::where("is_deleted" , 0)->get();
    return view('courses.index', [
      "title" => "Dashboard course",
      "courses"=>$courses
    ]);
  }

  // [get] /student/my_courses
  public function showMyCourses()
  {
      return view('students.my_courses', [
          "title" => "my Course"
      ]);
  }
  // 2. Giao diện thêm mới
    public function create()
    {
        // Cần lấy danh mục và giảng viên để chọn trong <select>
        $categories = Category::all();
        $instructors = User::where('role', 1)->get(); // Giả sử role 1 là giảng viên

        return view('courses.create', [
            'title' => 'Thêm khóa học',
            'categories' => $categories,
            'instructors' => $instructors

        ]);
    }

    // 3. Xử lý lưu mới
    public function store(Request $request)
    {
        // Validate dữ liệu (bạn có thể thêm rules tùy ý)
        $data = $request->all();
        $data['is_deleted'] = 0; // Mặc định chưa xóa

        Course::create($data);

        return redirect()->route('courses.index')->with('msg', 'Thêm thành công!');
    }

   public function edit($id)
{
    $course = Course::find($id);
    

    // Nếu không tìm thấy khóa học thì báo lỗi 404
    if (!$course) {
        return redirect()->route('courses.index')->with('msg', 'Không tìm thấy khóa học!');
    }

    $categories = Category::all();
    // Lấy list giảng viên (role = 1)
    $instructors = User::where('role', 1)->get(); 

    return view('courses.edit', [
        'title' => 'Sửa khóa học',
        'course' => $course,
        'categories' => $categories,
        'instructors' => $instructors
    ]);
}
    // 5. Xử lý cập nhật
    public function update(Request $request, $id)
    {
        $course = Course::find($id);
        $course->update($request->all());

        return redirect()->route('courses.index')->with('msg', 'Cập nhật thành công!');
    }

    public function destroy($id)
    {
        $course = Course::find($id);
        $course->is_deleted = 1; // Đánh dấu là đã xóa
        $course->save();

        return redirect()->route('courses.index')->with('msg', 'Xóa thành công!');
    }
  
}

