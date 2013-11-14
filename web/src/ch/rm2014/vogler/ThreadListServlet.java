package ch.rm2014.vogler;

import java.io.IOException;
import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.ArrayList;
import java.util.HashMap;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;

@WebServlet("/thread_list")
public class ThreadListServlet extends HttpServlet {

	private static final long serialVersionUID = 1L;

	protected ArrayList<Thread> getThreads(Connection connection, String keyword)
			throws SQLException {

		if (keyword == null) {
			keyword = "%";
		} else {
			keyword = "%" + keyword + "%";
		}

		PreparedStatement statement = connection
				.prepareStatement(""
						+ "SELECT t.id_thread, t.name_thread, c.id_comment, c.content, c.rating_up, c.rating_down "
						+ "FROM thread t INNER JOIN comment c ON c.id_thread = t.id_thread WHERE t.name_thread LIKE ? OR c.content LIKE ? "
						+ "GROUP BY t.id_thread ORDER BY t.id_thread DESC");
		statement.setString(1, keyword);
		statement.setString(2, keyword);
		statement.execute();

		ResultSet resultSet = statement.getResultSet();

		ArrayList<Thread> threads = new ArrayList<>();
		while (resultSet.next()) {
			Thread thread = Thread.create(resultSet);
			threads.add(thread);
		}

		return threads;
	}

	protected void doGet(HttpServletRequest request,
			HttpServletResponse response) throws ServletException, IOException {

		try {

			String keyword = request.getParameter("keyword");

			Database database = Database.getInstance();
			Connection connection = database.getConnection();

			request.setAttribute("threads", getThreads(connection, keyword));

			getServletContext().getRequestDispatcher(
					"/WEB-INF/jsps/thread_list.jsp").forward(request, response);

		} catch (ClassNotFoundException e) {
			e.printStackTrace();
		} catch (SQLException e) {
			e.printStackTrace();
		}
	}

	protected void doPost(HttpServletRequest request,
			HttpServletResponse response) throws ServletException, IOException {

		try {

			String nameAuthor = request.getParameter("name_author");
			String emailAuthor = request.getParameter("email_author");
			String nameThread = request.getParameter("name_thread");
			String content = request.getParameter("content");

			HashMap<String, String> errors = new HashMap<>();

			if (nameAuthor.equals("")) {
				errors.put("name_author", "Please enter your name");
			}

			if (emailAuthor.equals("")) {
				errors.put("email_author", "Please enter your email");
			} else if (!emailAuthor.contains("@")) {
				errors.put("email_author", "Please enter a valid email");
			}

			if (nameThread.equals("")) {
				errors.put("name_thread", "Please enter a thread name");
			}

			if (content.equals("")) {
				errors.put("content", "Please enter your question");
			}

			Database database = Database.getInstance();
			Connection connection = database.getConnection();

			if (errors.size() > 0) {

				request.setAttribute("errors", errors);
				request.setAttribute("threads", getThreads(connection, null));

				getServletContext().getRequestDispatcher(
						"/WEB-INF/jsps/thread_list.jsp").forward(request,
						response);
				return;
			}

			PreparedStatement statement = connection.prepareStatement(
					"INSERT INTO thread (name_thread) VALUES (?)",
					Statement.RETURN_GENERATED_KEYS);
			statement.setString(1, nameThread);
			statement.execute();

			ResultSet rs = statement.getGeneratedKeys();
			rs.next();
			int idThread = rs.getInt(1);

			statement = connection
					.prepareStatement("INSERT INTO comment (name_author, email_author, content, id_thread) VALUES (?, ?, ?, ?)");
			statement.setString(1, nameAuthor);
			statement.setString(2, emailAuthor);
			statement.setString(3, content);
			statement.setInt(4, idThread);
			statement.execute();

			response.sendRedirect("thread_list");

		} catch (ClassNotFoundException e) {
			e.printStackTrace();
		} catch (SQLException e) {
			e.printStackTrace();
		}
	}
}
