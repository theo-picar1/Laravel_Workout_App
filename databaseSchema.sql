DROP DATABASE IF EXISTS Forged_Gym;
CREATE DATABASE Forged_Gym;
USE Forged_Gym;

-- DROP TABLES IF THEY EXIST (to avoid issues on re-run)
DROP TABLE IF EXISTS post_comments, post_likes, posts, user_following, session_logs, workout_sessions, routine_exercise_sets, routine_exercises, workout_routines, exercise_muscles, exercises, muscles, equipment_types, users;

-- USERS
CREATE TABLE Users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    password_hash TEXT NOT NULL,
    profile_picture TEXT,
    bio TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- EQUIPMENT TYPES
CREATE TABLE Equipment_Types (
    equipment_type_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL
);

-- MUSCLES
CREATE TABLE Muscles (
    muscle_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL
);

-- EXERCISES
CREATE TABLE Exercises (
    exercise_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    equipment_type_id INT,
    instructions TEXT,
    image_url TEXT,
    FOREIGN KEY (equipment_type_id) REFERENCES equipment_types(equipment_type_id)
);

-- EXERCISE_MUSCLES
CREATE TABLE Exercise_Muscles (
    exercise_id INT,
    muscle_id INT,
    PRIMARY KEY (exercise_id, muscle_id),
    FOREIGN KEY (exercise_id) REFERENCES exercises(exercise_id) ON DELETE CASCADE,
    FOREIGN KEY (muscle_id) REFERENCES muscles(muscle_id) ON DELETE CASCADE
);

-- WORKOUT ROUTINES
CREATE TABLE Workout_Routines (
    routine_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    name VARCHAR(100) NOT NULL,
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

-- ROUTINE_EXERCISES
CREATE TABLE Routine_Exercises (
    routine_exercise_id INT AUTO_INCREMENT PRIMARY KEY,
    routine_id INT,
    exercise_id INT,
    exercise_order INT DEFAULT 1,
    FOREIGN KEY (routine_id) REFERENCES workout_routines(routine_id) ON DELETE CASCADE,
    FOREIGN KEY (exercise_id) REFERENCES exercises(exercise_id) ON DELETE CASCADE
);

-- ROUTINE_EXERCISE_SETS
CREATE TABLE Routine_Exercise_Sets (
    set_id INT AUTO_INCREMENT PRIMARY KEY,
    routine_exercise_id INT,
    set_number INT,
    reps INT,
    weight FLOAT,
    FOREIGN KEY (routine_exercise_id) REFERENCES routine_exercises(routine_exercise_id) ON DELETE CASCADE
);

-- WORKOUT SESSIONS
CREATE TABLE Workout_Sessions (
    session_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    routine_id INT,
    started_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ended_at TIMESTAMP NULL,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (routine_id) REFERENCES workout_routines(routine_id)
);

-- SESSION LOGS
CREATE TABLE Session_Logs (
    session_log_id INT AUTO_INCREMENT PRIMARY KEY,
    session_id INT,
    exercise_id INT,
    set_number INT,
    reps INT,
    weight FLOAT,
    FOREIGN KEY (session_id) REFERENCES workout_sessions(session_id) ON DELETE CASCADE,
    FOREIGN KEY (exercise_id) REFERENCES exercises(exercise_id)
);


-- Social aspect of the app

-- USER FOLLOWING
CREATE TABLE User_Following (
    follower_id INT,
    following_id INT,
    PRIMARY KEY (follower_id, following_id),
    FOREIGN KEY (follower_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (following_id) REFERENCES users(user_id) ON DELETE CASCADE
);

-- POSTS
CREATE TABLE Posts (
    post_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    caption TEXT,
    image_url TEXT,
    routine_id INT,
    session_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (routine_id) REFERENCES workout_routines(routine_id) ON DELETE SET NULL,
    FOREIGN KEY (session_id) REFERENCES workout_sessions(session_id) ON DELETE SET NULL
);

-- POST LIKES
CREATE TABLE Post_Likes (
    like_id INT AUTO_INCREMENT PRIMARY KEY,
    post_id INT,
    user_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UNIQUE(post_id, user_id),
    FOREIGN KEY (post_id) REFERENCES posts(post_id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);

-- POST COMMENTS
CREATE TABLE Post_Comments (
    comment_id INT AUTO_INCREMENT PRIMARY KEY,
    post_id INT,
    user_id INT,
    comment_text TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (post_id) REFERENCES posts(post_id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE
);
