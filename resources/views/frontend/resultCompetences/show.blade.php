@extends('layouts.frontend')
@section('styles')
<style>
    .blog-card {
        border: none;
        border-radius: 15px;
        overflow: hidden;
        transition: transform 0.3s ease;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .blog-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .blog-card img {
        border-radius: 15px 15px 0 0;
    }

    .blog-card-body {
        padding: 20px;
    }

    .blog-card-title {
        font-size: 1.5rem;
        font-weight: bold;
        color: #343a40;
    }

    .blog-card-text {
        color: #6c757d;
    }

    .blog-card-author {
        font-size: 0.9rem;
        color: #6f42c1; /* Purple color */
        margin-bottom: 10px;
    }

    .read-more-btn {
        background-color: #6f42c1; /* Purple color */
        color: white;
        border-radius: 50px;
        padding: 10px 20px;
        transition: background-color 0.3s ease;
    }

    .read-more-btn:hover {
        background-color: #563d7c; /* Darker purple */
        color: white;
    }

    .blog-card-footer {
        border-top: 1px solid #e9ecef;
        padding-top: 10px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
</style>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">

            <div class="card">
                <div class="card-header">
                    List Lesson For {{ $competence->name }} Competence
                </div>

                <div class="card-body">
                    @foreach ($competence_list as $item)
                        <!-- Lesson 1: Internal Video -->
                        <div class="card mb-4 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title"><i class="bi bi-play-circle-fill me-2"></i>Internal Video Lesson</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Understanding the Basics</h6>
                                <video controls class="w-100 rounded mb-3">
                                    <source src="video-url.mp4" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                                <p class="card-text">
                                    This article provides a comprehensive exploration of the topic, covering various aspects in great detail. The content is structured to offer deep insights and a thorough understanding of the subject matter.
                                    The article is broken down into sections for easier readability, and includes various examples and case studies to illustrate key points.
                                    <br><br>
                                    The first section delves into the historical context, while subsequent sections focus on the current trends and future predictions.
                                    Throughout the article, references to research papers and authoritative sources are provided to back up the claims and arguments presented.
                                </p>
                            </div>
                        </div>
                    @endforeach

                    <!-- Lesson 2: Long Article -->
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title"><i class="bi bi-file-text-fill me-2"></i>Long Article</h5>
                            <h6 class="card-subtitle mb-2 text-muted">In-depth Analysis</h6>
                            <p class="card-text">
                                This article provides a comprehensive exploration of the topic, covering various aspects in great detail. The content is structured to offer deep insights and a thorough understanding of the subject matter.
                                The article is broken down into sections for easier readability, and includes various examples and case studies to illustrate key points.
                                <br><br>
                                The first section delves into the historical context, while subsequent sections focus on the current trends and future predictions.
                                Throughout the article, references to research papers and authoritative sources are provided to back up the claims and arguments presented.
                            </p>
                        </div>
                    </div>

                    <!-- Lesson 3: Image with Long Article and Description -->
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title"><i class="bi bi-image-fill me-2"></i>Image Lesson with Article</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Visual Learning</h6>
                            <img src="{{ asset('jobcy/images/featured-job/img-01.png') }}" alt="Lesson Image" class="img-fluid rounded mb-3">
                            <p class="card-text">
                                This lesson uses a powerful image to convey the main ideas of the topic, accompanied by an in-depth article that explains the concepts in detail.
                                The image serves as a visual representation of the key points, helping to reinforce the information presented in the text.
                                <br><br>
                                The article further elaborates on the image, providing context and additional insights. It is structured to guide the reader through the thought process behind the image, making it easier to grasp the underlying concepts.
                            </p>
                        </div>
                    </div>

                    <!-- Lesson 4: Embedded Video from YouTube or Coursera -->
                    <div class="card mb-4 shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title"><i class="bi bi-youtube me-2"></i>Embedded Video Lesson</h5>
                            <h6 class="card-subtitle mb-2 text-muted">Advanced Techniques</h6>
                            <div class="ratio ratio-16x9 mb-3">
                                <iframe src="https://www.youtube.com/embed/dQw4w9WgXcQ" title="YouTube video" allowfullscreen></iframe>
                            </div>
                            <p class="card-text">
                                This lesson features an advanced tutorial from a well-known online platform, providing expert insights and practical tips.
                                The video covers complex techniques and strategies, making it ideal for learners who have already mastered the basics and are looking to take their skills to the next level.
                            </p>
                        </div>
                    </div>

                    <div class="form-group">
                        <a class="btn btn-default" href="{{ route('frontend.competences.index') }}">
                            {{ trans('global.back_to_list') }}
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
