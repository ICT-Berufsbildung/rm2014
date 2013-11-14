package ch.rm2014.vogler;

import java.sql.ResultSet;
import java.sql.SQLException;

public class Thread {

	private int idThread = 0;

	private int idComment = 0;

	private String name = "";

	private String content = "";

	private int ratingUp = 0;

	private int ratingDown = 0;

	public int getIdThread() {
		return idThread;
	}

	public int getIdComment() {
		return idComment;
	}

	public String getName() {
		return name;
	}

	public String getContent() {
		return content;
	}

	public int getRatingUp() {
		return ratingUp;
	}

	public int getRatingDown() {
		return ratingDown;
	}

	public static Thread create(ResultSet resultSet) throws SQLException {
		Thread thread = new Thread();
		thread.idThread = resultSet.getInt("id_thread");
		thread.idComment = resultSet.getInt("id_comment");
		thread.name = resultSet.getString("name_thread");
		thread.content = resultSet.getString("content");
		thread.ratingUp = resultSet.getInt("rating_up");
		thread.ratingDown = resultSet.getInt("rating_down");
		return thread;
	}
}
