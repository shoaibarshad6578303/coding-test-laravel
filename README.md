### Brief Explanation :

The search functionality is implemented by defining a base query on the Customer model and applying conditional filters using where, whereHas, and eager loading (with). This approach ensures that only the necessary data is loaded from the database, optimizing performance. The use of whereHas allows filtering based on related models, while eager loading (with) prevents multiple queries for related data, thus reducing query overhead. Additionally, pagination is used to handle large datasets efficiently.

If we have more load on DB due to high number of users then we can apply cache to decrease the load on DB and increased speed as well.

