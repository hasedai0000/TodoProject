/**
 * TodoContext
 *
 * @package contexts
 */

import { useTodo } from '@/hooks/useTodo';
import { TodoType } from '@/interfaces/Todo';
import { createContext, FC, ReactNode, useContext } from 'react';

type Props = {
  children: ReactNode;
};

type ContextType = {
  originTodoList: Array<TodoType>;
  deleteTodo: (todoId: number) => Promise<void>;
};

const TodoContext = createContext({} as ContextType);

/**
 * TodoProvider
 *
 * @package contexts
 */
export const TodoProvider: FC<Props> = ({ children }) => {
  // カスタムフックから状態とロジックを呼び出してコンテキストプロバイダーにあてがう
  const { originTodoList, deleteTodo } = useTodo();

  return <TodoContext.Provider value={{ originTodoList, deleteTodo }}>{children}</TodoContext.Provider>;
};

export const useTodoContext = () => useContext(TodoContext);
