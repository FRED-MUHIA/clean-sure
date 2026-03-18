<?php

namespace App\Http\Controllers;

class BlogController extends Controller
{
    public function index()
    {
        return view('pages.blog');
    }

    public function show(string $id)
    {
        $blogs = $this->loadBlogs();
        $post = null;

        foreach ($blogs as $blog) {
            if (($blog['id'] ?? '') === $id) {
                $post = $blog;
                break;
            }
        }

        abort_if($post === null, 404);

        $related = array_values(array_filter(
            $blogs,
            static fn (array $blog): bool => ($blog['id'] ?? '') !== ($post['id'] ?? '')
        ));
        $related = array_slice($related, 0, 3);

        return view('pages.blog-show', [
            'post' => $post,
            'related' => $related,
        ]);
    }

    private function loadBlogs(): array
    {
        $file = public_path('data/blogs.json');
        if (!is_file($file)) {
            return [];
        }

        $json = file_get_contents($file);
        if ($json === false) {
            return [];
        }

        $decoded = json_decode($json, true);
        if (!is_array($decoded)) {
            return [];
        }

        usort(
            $decoded,
            static fn (array $a, array $b): int =>
                strtotime((string) ($b['date'] ?? '')) <=> strtotime((string) ($a['date'] ?? ''))
        );

        return $decoded;
    }
}
