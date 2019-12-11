DROP TABLE Workouts;
DROP TABLE Reviews;
DROP TABLE Exercises;
DROP TABLE Users;

CREATE TABLE Users (
	userID INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    name VARCHAR(45) NOT NULL,
    email VARCHAR(45) NOT NULL UNIQUE,
    image VARCHAR(512) NOT NULL
);

CREATE TABLE Reviews (
	reviewID INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    userID INT(11) NOT NULL,
    review VARCHAR(100) NOT NULL,
    rating INT(11) NOT NULL,
    updatedAt DATETIME NOT NULL,
    FOREIGN KEY (userID) REFERENCES Users(userID)
);

CREATE TABLE Exercises (
	exerciseID INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    exerciseName VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE Workouts (
	workoutID INT(11) PRIMARY KEY NOT NULL AUTO_INCREMENT,
    userID INT(11) NOT NULL,
    exerciseID INT(11) NOT NULL,
    sets INT(11) NOT NULL,
    reps INT(11) NOT NULL,
    FOREIGN KEY (userID) REFERENCES Users(userID),
    FOREIGN KEY (exerciseID) REFERENCES Exercises(exerciseID)
);

SELECT Workouts.workoutID, Exercises.exerciseName, Workouts.sets, Workouts.reps 
	FROM Workouts 
	JOIN Exercises
		ON Workouts.exerciseID = Exercises.exerciseID
    WHERE userID = 10;